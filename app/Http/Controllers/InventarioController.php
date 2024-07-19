<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class InventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view.inventory')->only('index', 'show');
        $this->middleware('can:manage.inventory')->only('create', 'store', 'edit', 'update', 'destroy');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $inventarios = Inventario::where('inventario_id', 'like', "%{$search}%")
                ->orWhereHas('producto', function ($query) use ($search) {
                    $query->where('nombre_producto', 'like', "%{$search}%");
                })
                ->paginate(10);
        } else {
            $inventarios = Inventario::with('producto')->paginate(10);
        }

        return view('inventario.index', compact('inventarios'))
            ->with('i', (request()->input('page', 1) - 1) * $inventarios->perPage());
    }


    public function create()
    {
        $inventario = new Inventario();
        $productos = Producto::all();
        return view('inventario.create', compact('inventario', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'stock' => 'required|integer',
            'fecha_movimiento' => 'required|date',
            'producto_id' => 'required|exists:productos,producto_id',
        ]);

        Inventario::create($request->all());

        return redirect()->route('inventarios.index')
            ->with('success', 'Inventario creado exitosamente.');
    }

    public function show($id)
    {
        $inventario = Inventario::with('producto')->findOrFail($id);

        return view('inventario.show', compact('inventario'));
    }

    public function edit($id)
    {
        $inventario = Inventario::findOrFail($id);
        // Formatear la fecha a YYYY-MM-DD si no está en ese formato
        $inventario->fecha_movimiento = Carbon::parse($inventario->fecha_movimiento)->format('Y-m-d');
        $productos = Producto::all();
        return view('inventario.edit', compact('inventario', 'productos'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required|integer',
            'fecha_movimiento' => 'required|date',
            'producto_id' => 'required|exists:productos,producto_id',
        ]);

        $inventario = Inventario::findOrFail($id);
        $inventario->update($request->all());

        return redirect()->route('inventarios.index')
            ->with('success', 'Inventario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $inventario = Inventario::findOrFail($id);
        $inventario->delete();

        return redirect()->route('inventarios.index')
            ->with('success', 'Inventario eliminado exitosamente.');
    }

    public function exportPdf()
    {
        $inventario = Inventario::all();
        $pdf = PDF::loadView('inventario.pdf', compact('inventario'));
        $currentDate = Carbon::now()->format('d-m-Y'); // Formato de fecha: dd-mm-yyyy
        $filename = 'Inventario-' . $currentDate . '.pdf';
        return $pdf->download($filename);
    }
}
