<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDetalleventa;
use App\Models\Detalleventa;
use Illuminate\Http\Request;

/**
 * Class DetalleventaController
 * @package App\Http\Controllers
 */
class DetalleventaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('can:view.salesdetails')->only('index','show');
        $this->middleware('can:create.salesdetails')->only('create','store');
        $this->middleware('can:edit.salesdetails')->only('edit','update');
        $this->middleware('can:delete.salesdetails')->only('destroy');
    }
    
    public function index()
    {
        $detalleventas = Detalleventa::paginate(10);

        return view('detalleventa.index', compact('detalleventas'))
            ->with('i', (request()->input('page', 1) - 1) * $detalleventas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detalleventa = new Detalleventa();
        return view('detalleventa.create', compact('detalleventa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDetalleventa $request)
    {
        // request()->validate(Detalleventa::$rules);
        // $detalleventa = Detalleventa::create($request->all());

        $detalleventa = new Detalleventa();
        $detalleventa->precio_venta_unidad = $request->precio_venta_unidad;
        $detalleventa->descuento  = $request->descuento;
        $detalleventa->impuesto = $request->impuesto;
        $detalleventa->save();
        return redirect()->route('detalleventas.index')
            ->with('success', 'Detalleventa created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalleventa = Detalleventa::find($id);

        return view('detalleventa.show', compact('detalleventa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detalleventa = Detalleventa::find($id);

        return view('detalleventa.edit', compact('detalleventa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Detalleventa $detalleventa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detalleventa $detalleventa)
    {
        // request()->validate(Detalleventa::$rules);
        // $detalleventa->update($request->all());
        $detalleventa->precio_venta_unidad = $request->precio_venta_unidad;
        $detalleventa->descuento  = $request->descuento;
        $detalleventa->impuesto = $request->impuesto;
        $detalleventa->save();
        return redirect()->route('detalleventas.index')
            ->with('success', 'Detalleventa updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $detalleventa = Detalleventa::find($id)->delete();

        return redirect()->route('detalleventas.index')
            ->with('success', 'Detalleventa deleted successfully');
    }
}
