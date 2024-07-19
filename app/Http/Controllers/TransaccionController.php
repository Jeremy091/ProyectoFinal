<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaccion;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Inventario;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class TransaccionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view.transactions')->only('index', 'show');
        $this->middleware('can:create.transactions')->only('create', 'store');
        $this->middleware('can:edit.transactions')->only('edit', 'update');
        $this->middleware('can:delete.transactions')->only('destroy');
    }

    public function index(Request $request)
    {

        $search = $request->input('search');

        if ($search) {
            $transaccions = Transaccion::where('transaccion_id', 'like', "%{$search}%")
               // ->orWhere('id', 'like', "%{$search}%")
                ->paginate(10);
        } else {
            $transaccions = Transaccion::with('productos', 'cliente')->paginate(10);
        }

        return view('transaccion.index', compact('transaccions'))
            ->with('i', (request()->input('page', 1) - 1) * $transaccions->perPage());
    }

    public function create()
    {
        $productos = Producto::all();
        $clientes = Cliente::all();
        $transaccion = new Transaccion();

        return view('transaccion.create', compact('transaccion', 'productos', 'clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_transaccion' => 'required|date',
            'total_transaccion' => 'required|numeric',
            'metodo_pago' => 'required',
            'tipo_transaccion' => 'required',
            'cliente_id' => 'required|exists:clientes,cliente_id',
            'producto_id.*' => 'required|exists:productos,producto_id',
            'cantidad.*' => 'required|numeric|min:1',
            'precio_unitario.*' => 'required|numeric|min:0',
        ]);

        // Verificar stock antes de crear la transacción
        foreach ($request->producto_id as $key => $producto_id) {
            $cantidad = $request->cantidad[$key];
            $inventario = Inventario::where('producto_id', $producto_id)->first();

            if (!$inventario || $inventario->stock < $cantidad) {
                return redirect()->back()->withErrors(['error' => 'No hay suficiente stock para el producto ' . $producto_id]);
            }
        }

        // Crear la transacción
        $transaccion = Transaccion::create($request->only([
            'transaccion_id',
            'fecha_transaccion',
            'total_transaccion',
            'metodo_pago',
            'tipo_transaccion',
            'cliente_id',
        ]));

        $productos = [];
        foreach ($request->producto_id as $key => $producto_id) {
            $cantidad = $request->cantidad[$key];
            $productos[$producto_id] = [
                'cantidad' => $cantidad,
                'precio_unitario' => $request->precio_unitario[$key],
            ];

            // Actualizar inventario
            $this->updateInventory($producto_id, -$cantidad);
        }

        $transaccion->productos()->attach($productos);

        return redirect()->route('transaccions.index')->with('success', 'Transacción y productos almacenados con éxito.');
    }


    public function show($id)
    {
        $transaccion = Transaccion::with('productos', 'cliente')->findOrFail($id);

        return view('transaccion.show', compact('transaccion'));
    }

    public function edit($id)
    {
        $transaccion = Transaccion::findOrFail($id);
        $productos = Producto::all();
        $clientes = Cliente::all();

        return view('transaccion.edit', compact('transaccion', 'productos', 'clientes'));
    }

    public function update(Request $request, Transaccion $transaccion)
    {
        $request->validate([
            'fecha_transaccion' => 'required|date',
            'total_transaccion' => 'required|numeric',
            'metodo_pago' => 'required',
            'tipo_transaccion' => 'required',
            'cliente_id' => 'required|exists:clientes,cliente_id',
            'producto_id.*' => 'required|exists:productos,producto_id',
            'cantidad.*' => 'required|numeric|min:1',
            'precio_unitario.*' => 'required|numeric|min:0',
        ]);

        // Obtener los productos y cantidades actuales
        $productos_actuales = $transaccion->productos()->pluck('cantidad', 'producto_id')->toArray();

        // Verificar stock antes de actualizar la transacción
        foreach ($request->producto_id as $key => $producto_id) {
            $nueva_cantidad = $request->cantidad[$key];
            $cantidad_actual = $productos_actuales[$producto_id] ?? 0;
            $diferencia_cantidad = $nueva_cantidad - $cantidad_actual;

            $inventario = Inventario::where('producto_id', $producto_id)->first();

            if (!$inventario || $inventario->stock < $diferencia_cantidad) {
                return redirect()->back()->withErrors(['error' => 'No hay suficiente stock para el producto ' . $producto_id]);
            }
        }

        // Actualizar la transacción
        $transaccion->update($request->only([
            'fecha_transaccion',
            'total_transaccion',
            'metodo_pago',
            'tipo_transaccion',
            'cliente_id',
        ]));

        $productos = [];
        foreach ($request->producto_id as $key => $producto_id) {
            $cantidad = $request->cantidad[$key];
            $productos[$producto_id] = [
                'cantidad' => $cantidad,
                'precio_unitario' => $request->precio_unitario[$key],
            ];

            // Calcular la diferencia en cantidad y actualizar el inventario
            $cantidad_actual = $productos_actuales[$producto_id] ?? 0;
            $diferencia_cantidad = $cantidad - $cantidad_actual;

            $this->updateInventory($producto_id, -$diferencia_cantidad);
        }

        $transaccion->productos()->sync($productos);

        return redirect()->route('transaccions.index')->with('success', 'Transacción actualizada con éxito.');
    }


    public function destroy($id)
    {
        $transaccion = Transaccion::findOrFail($id);
        $transaccion->productos()->detach();
        $transaccion->delete();

        return redirect()->route('transaccions.index')->with('success', 'Transacción eliminada exitosamente.');
    }
    // Método para actualizar el inventario
    private function updateInventory($producto_id, $cantidad)
    {
        $inventario = Inventario::where('producto_id', $producto_id)->first();

        if ($inventario) {
            $inventario->stock += $cantidad;
            $inventario->fecha_movimiento = now();
            $inventario->save();
        } else {
            Inventario::create([
                'producto_id' => $producto_id,
                'stock' => $cantidad,
                'fecha_ingreso' => now(),
                'fecha_movimiento' => now(),
                // 'tipo_movimiento' => 'venta',
            ]);
        }
    }

    public function exportPdf()
    {
        $transaccions = Transaccion::all();
        $pdf = PDF::loadView('transaccion.pdf', compact('transaccions'));
        $currentDate = Carbon::now()->format('d-m-Y'); // Formato de fecha: dd-mm-yyyy
        $filename = 'Transacciones-' . $currentDate . '.pdf';
        return $pdf->download($filename);
    }
    
    
}
