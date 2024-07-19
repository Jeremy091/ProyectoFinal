<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompra;
use App\Models\Categoria;
use App\Models\Inventario;
use App\Models\Compra;
use App\Models\Proveedore;
use App\Models\Producto;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view.purchases')->only('index', 'show');
        $this->middleware('can:create.purchases')->only('create', 'store');
        $this->middleware('can:edit.purchases')->only('edit', 'update');
        $this->middleware('can:delete.purchases')->only('destroy');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $compras = Compra::with('proveedor')
                ->where('numero_factura', 'like', "%{$search}%")
                ->orWhereHas('proveedor', function ($query) use ($search) {
                    $query->where('nombre_proveedor', 'like', "%{$search}%");
                })
                ->paginate(10);
        } else {
            $compras = Compra::with('proveedor')->paginate(10);
        }

        return view('compra.index', compact('compras'))
            ->with('i', (request()->input('page', 1) - 1) * $compras->perPage());
    }

    public function create()
    {
        $compra = new Compra();
        $proveedores = Proveedore::all();
        $productos = Producto::all();
        $categorias = Categoria::all();

        // Generar un número de factura único con el formato COM-2024-001
        $ultimoNumeroFactura = Compra::max('numero_factura');

        if ($ultimoNumeroFactura) {
            // Extraer el número secuencial de la última factura
            $ultimoSecuencial = (int)substr($ultimoNumeroFactura, -3);
            $nuevoSecuencial = $ultimoSecuencial + 1;
        } else {
            $nuevoSecuencial = 1;
        }

        // Formatear el número secuencial con ceros a la izquierda
        $nuevoNumeroFactura = 'COM-' . date('Y') . '-' . str_pad($nuevoSecuencial, 3, '0', STR_PAD_LEFT);

        return view('compra.create', compact('compra', 'proveedores', 'productos', 'categorias', 'nuevoNumeroFactura'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'numero_factura' => 'required|string|max:255',
            'fecha_compra' => 'required|date',
            'subtotal' => 'required|numeric',
            'impuesto' => 'required|numeric',
            'total_compra' => 'required|numeric',
            'metodo_pago' => 'required|string',
            'estado' => 'required|string',
            'proveedor_id' => 'required|integer|exists:proveedores,proveedor_id',
            'producto_id' => 'required|array',
            'producto_id.*' => 'required|integer|exists:productos,producto_id',
            'cantidad' => 'required|array',
            'cantidad.*' => 'required|integer|min:1',
            'precio_compra' => 'required|array',
            'precio_compra.*' => 'required|numeric|min:0',
        ]);

        $compra = new Compra();
        $compra->numero_factura = $request->numero_factura;
        $compra->fecha_compra = $request->fecha_compra;
        $compra->subtotal = $request->subtotal;
        $compra->impuesto = $request->impuesto;
        $compra->total_compra = $request->total_compra;
        $compra->metodo_pago = $request->metodo_pago;
        $compra->estado = $request->estado;
        $compra->proveedor_id = $request->proveedor_id;
        $compra->save();

        foreach ($validatedData['producto_id'] as $key => $producto_id) {
            $compra->productos()->attach($producto_id, [
                'cantidad' => $validatedData['cantidad'][$key],
                'precio_compra' => $validatedData['precio_compra'][$key],
            ]);
        }

        return redirect()->route('compras.index')->with('success', 'Compra creada con éxito.');
    }

    public function show(Compra $compra)
    {
        $compra->load('proveedor', 'productos');
        return view('compra.show', compact('compra'));
    }

    public function edit($id)
    {
        $compra = Compra::with('productos')->findOrFail($id);
        $proveedores = Proveedore::all();
        $productos = Producto::all();
        $categorias = Categoria::all();

        return view('compra.edit', compact('compra', 'proveedores', 'productos', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'numero_factura' => 'required|string|max:255',
            'fecha_compra' => 'required|date',
            'subtotal' => 'required|numeric',
            'impuesto' => 'required|numeric',
            'total_compra' => 'required|numeric',
            'metodo_pago' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'proveedor_id' => 'required|integer',
            'producto_id.*' => 'required|integer',
            'cantidad.*' => 'required|integer',
            'precio_compra.*' => 'required|numeric',
        ]);

        $compra = Compra::findOrFail($id);
        $compra->update($validated);
        $compra->productos()->detach();

        foreach ($request->producto_id as $key => $producto_id) {
            $compra->productos()->attach($producto_id, [
                'cantidad' => $request->cantidad[$key],
                'precio_compra' => $request->precio_compra[$key],
            ]);

            // Actualizar inventario
            $this->updateInventory($producto_id, $request->cantidad[$key]);
        }

        return redirect()->route('compras.index')->with('success', 'Compra actualizada exitosamente.');
    }

    public function destroy(Compra $compra)
    {
        $compra->delete();
        return redirect()->route('compras.index')
            ->with('success', 'Compra eliminada exitosamente.');
    }

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
                // 'tipo_movimiento' => 'compra',
            ]);
        }
    }
}
