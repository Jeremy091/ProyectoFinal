<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRole;
// use App\Models\Role;
use Illuminate\Http\Request;
// use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class RoleController
 * @package App\Http\Controllers
 */
class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view.roles')->only('index', 'show');
        $this->middleware('can:create.roles')->only('create', 'store');
        $this->middleware('can:edit.roles')->only('edit', 'update');
        $this->middleware('can:delete.roles')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(10);

        return view('role.index', compact('roles'))
            ->with('i', (request()->input('page', 1) - 1) * $roles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $role = new Role();
        return view('role.create', compact('role', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRole $request)
    {
        // Verificar si el rol ya existe
        $existingRole = Role::where('name', $request->name)->where('guard_name', 'web')->first();

        if ($existingRole) {
            return redirect()->route('roles.index')
                ->with('error', 'Role already exists.');
        }

        // Crear una nueva instancia del modelo Role
        $role = new Role();

        // Asignar manualmente los valores del request a la instancia del modelo
        $role->name = $request->name;
        $role->description = $request->description;
        $role->guard_name = 'web';

        // Guardar la instancia en la base de datos
        $role->save();

        // Asignar permisos al rol si se proporcionan
        if ($request->has('permissions')) {
            // Convertir IDs de permisos a nombres de permisos
            $permissions = Permission::whereIn('id', $request->permissions)->get();

            // Asignar permisos al rol
            $role->syncPermissions($permissions);
        }

        // Redirigir al índice de roles con un mensaje de éxito
        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    // Controlador
    public function show(Role $role)
    {
        $rolePermissions = $role->permissions()->pluck('id')->toArray(); // Obtener IDs de permisos
        return view('role.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Obtener el rol a actualizar
        $role = Role::findOrFail($id);

        // Actualizar los datos del rol con los valores del request
        $role->name = $request->name;
        $role->description = $request->description;
        $role->guard_name = 'web';

        // Guardar los cambios
        $role->save();

        // Actualizar permisos del rol
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);
        } else {
            // Si no se proporcionaron nuevos permisos, sincronizar con un array vacío para eliminar todos los permisos
            $role->syncPermissions([]);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $role = Role::find($id)->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
