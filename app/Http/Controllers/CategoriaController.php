<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoria;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view.categories')->only('index', 'show');
        $this->middleware('can:create.categories')->only('create', 'store');
        $this->middleware('can:edit.categories')->only('edit', 'update');
        $this->middleware('can:delete.categories')->only('destroy');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $categorias = Categoria::where('nombre_categoria', 'like', "%{$search}%")
                ->orWhere('descripcion_categoria', 'like', "%{$search}%")
                ->orWhere('categoria_id', 'like', "%{$search}%")
                ->paginate(10);
        } else {
            $categorias = Categoria::paginate(10);
        }

        return view('categoria.index', compact('categorias'))
            ->with('i', (request()->input('page', 1) - 1) * $categorias->perPage());
    }

    public function create()
    {
        $categoria = new Categoria();
        return view('categoria.create', compact('categoria'));
    }

    public function store(StoreCategoria $request)
    {
        $categoria = new Categoria();
        $categoria->nombre_categoria = $request->nombre_categoria;
        $categoria->descripcion_categoria  = $request->descripcion_categoria;
        $categoria->save();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria created successfully.');
    }

    public function show($id)
    {
        $categoria = Categoria::find($id);

        return view('categoria.show', compact('categoria'));
    }

    public function edit($id)
    {
        $categoria = Categoria::find($id);

        return view('categoria.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $categoria->nombre_categoria = $request->nombre_categoria;
        $categoria->descripcion_categoria  = $request->descripcion_categoria;
        $categoria->save();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria updated successfully');
    }

    public function destroy($id)
    {
        Categoria::find($id)->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria deleted successfully');
    }

    public function exportPdf()
    {
        $categoria = Categoria::all();
        $pdf = PDF::loadView('categoria.pdf', compact('categoria'));
        $currentDate = Carbon::now()->format('d-m-Y'); // Formato de fecha: dd-mm-yyyy
        $filename = 'Categorias-' . $currentDate . '.pdf';
        return $pdf->download($filename);
    }
    
}

