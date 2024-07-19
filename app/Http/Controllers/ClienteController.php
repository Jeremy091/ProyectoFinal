<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCliente;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


/**
 * Class ClienteController
 * @package App\Http\Controllers
 */
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('can:view.clients')->only('index', 'show');
        $this->middleware('can:create.clients')->only('create', 'store');
        $this->middleware('can:edit.clients')->only('edit', 'update');
        $this->middleware('can:delete.clients')->only('destroy');
    }

    public function index(Request $request)
    {

        $search = $request->input('search');

        if ($search) {
            $clientes = Cliente::where('nombre_cliente', 'like', "%{$search}%")
                ->orWhere('apellido_cliente', 'like', "%{$search}%")
                ->orWhere('cliente_id', 'like', "%{$search}%")
                ->orWhere('email_cliente', 'like', "%{$search}%")
                ->orWhere('telefono_cliente', 'like', "%{$search}%")
                ->orWhere('direccion_cliente', 'like', "%{$search}%")
                ->paginate(10);
        } else {
            $clientes = Cliente::paginate(10);
        }

        return view('cliente.index', compact('clientes'))
            ->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cliente = new Cliente();
        return view('cliente.create', compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    // ClienteController.php
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nombre_cliente' => 'required|string|max:255',
        'apellido_cliente' => 'required|string|max:255',
        'cedula_cliente' => 'required|string|max:20|unique:clientes,cedula_cliente',
        'direccion_cliente' => 'required|string|max:255',
        'telefono_cliente' => 'required|string|max:15',
        'email_cliente' => 'required|string|email|max:255|unique:clientes,email_cliente',
    ]);

    $cliente = Cliente::create($validatedData);

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'cliente' => $cliente
        ]);
    } else {
        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.');
    }
}



    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);

        return view('cliente.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);

        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        // request()->validate(Cliente::$rules);
        // $cliente->update($request->all());
        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->apellido_cliente  = $request->apellido_cliente;
        $cliente->direccion_cliente = $request->direccion_cliente;
        $cliente->telefono_cliente  = $request->telefono_cliente;
        $cliente->email_cliente  = $request->email_cliente;
        $cliente->save();
        return redirect()->route('clientes.index')
            ->with('success', 'Cliente updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($cliente_id)
    {
        $cliente = Cliente::where('cliente_id', $cliente_id)->firstOrFail();
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente deleted successfully');
    }

    public function exportPdf()
    {
        $clientes = Cliente::all();
        $pdf = PDF::loadView('cliente.pdf', compact('clientes'));
        $currentDate = Carbon::now()->format('d-m-Y'); // Formato de fecha: dd-mm-yyyy
        $filename = 'Clientes-' . $currentDate . '.pdf';
        return $pdf->download($filename);
    }
}
