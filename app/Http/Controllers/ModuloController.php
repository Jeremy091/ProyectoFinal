<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModulo;
use App\Models\Modulo;
use Illuminate\Http\Request;

/**
 * Class ModuloController
 * @package App\Http\Controllers
 */
class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('can:view.modules')->only('index','show');
        $this->middleware('can:manage.modules')->only('create','store');
        $this->middleware('can:manage.modules')->only('edit','update');
        $this->middleware('can:manage.modules')->only('destroy');
    }
    public function index()
    {
        $modulos = Modulo::paginate(10);

        return view('modulo.index', compact('modulos'))
            ->with('i', (request()->input('page', 1) - 1) * $modulos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modulo = new Modulo();
        return view('modulo.create', compact('modulo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModulo $request)
    {
        // request()->validate(Modulo::$rules);
        // $modulo = Modulo::create($request->all());

        $modulo = new Modulo();
        $modulo->nombre_modulo = $request->nombre_modulo;
        $modulo->descripcion_modulo  = $request->descripcion_modulo;
        $modulo->save();
        return redirect()->route('modulos.index')
            ->with('success', 'Modulo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modulo = Modulo::find($id);

        return view('modulo.show', compact('modulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modulo = Modulo::find($id);

        return view('modulo.edit', compact('modulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Modulo $modulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modulo $modulo)
    {
        // request()->validate(Modulo::$rules);
        // $modulo->update($request->all());

        $modulo->nombre_modulo = $request->nombre_modulo;
        $modulo->descripcion_modulo  = $request->descripcion_modulo;
        $modulo->save();

        return redirect()->route('modulos.index')
            ->with('success', 'Modulo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $modulo = Modulo::find($id)->delete();

        return redirect()->route('modulos.index')
            ->with('success', 'Modulo deleted successfully');
    }
}
