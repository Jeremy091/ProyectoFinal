<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmpleado;
use App\Models\Empleado;
use Illuminate\Http\Request;

/**
 * Class EmpleadoController
 * @package App\Http\Controllers
 */
class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::paginate(10);

        return view('empleado.index', compact('empleados'))
            ->with('i', (request()->input('page', 1) - 1) * $empleados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleado = new Empleado();
        return view('empleado.create', compact('empleado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmpleado $request)
    {
        // request()->validate(Empleado::$rules);
        // $empleado = Empleado::create($request->all());

        $empleado = new Empleado();
        $empleado->nombre_empleado = $request->nombre_empleado;
        $empleado->apellido_empleado  = $request->apellido_empleado;
        $empleado->email_empleado = $request->email_empleado;
        $empleado->direccion_empleado  = $request->direccion_empleado;
        $empleado->telefono_empleado  = $request->telefono_empleado;
        $empleado->rol  = $request->rol;
        $empleado->save();
        return redirect()->route('empleados.index')
            ->with('success', 'Empleado created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::find($id);

        return view('empleado.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::find($id);

        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Empleado $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        // request()->validate(Empleado::$rules);
        // $empleado->update($request->all());

        $empleado->nombre_empleado = $request->nombre_empleado;
        $empleado->apellido_empleado  = $request->apellido_empleado;
        $empleado->email_empleado = $request->email_empleado;
        $empleado->direccion_empleado  = $request->direccion_empleado;
        $empleado->telefono_empleado  = $request->telefono_empleado;
        $empleado->rol  = $request->rol;
        $empleado->save();
        return redirect()->route('empleados.index')
            ->with('success', 'Empleado updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id)->delete();

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado deleted successfully');
    }
}
