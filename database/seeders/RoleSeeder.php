<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Elimina roles y permisos existentes para evitar duplicados
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos individualmente
        Permission::create(['name' => 'view.home', 'description' => 'Ver Home']);

        Permission::create(['name' => 'view.roles', 'description' => 'Ver roles']);
        Permission::create(['name' => 'create.roles', 'description' => 'Crear roles']);
        Permission::create(['name' => 'edit.roles', 'description' => 'Editar roles']);
        Permission::create(['name' => 'delete.roles', 'description' => 'Eliminar roles']);

        Permission::create(['name' => 'view.users', 'description' => 'Ver usuarios']);
        Permission::create(['name' => 'create.users', 'description' => 'Crear usuarios']);
        Permission::create(['name' => 'edit.users', 'description' => 'Editar usuarios']);
        Permission::create(['name' => 'delete.users', 'description' => 'Eliminar usuarios']);

        Permission::create(['name' => 'view.profile', 'description' => 'Ver Perfil']);

        Permission::create(['name' => 'view.categories', 'description' => 'Ver categorías']);
        Permission::create(['name' => 'create.categories', 'description' => 'Crear categorías']);
        Permission::create(['name' => 'edit.categories', 'description' => 'Editar categorías']);
        Permission::create(['name' => 'delete.categories', 'description' => 'Eliminar categorías']);

        Permission::create(['name' => 'view.clients', 'description' => 'Ver clientes']);
        Permission::create(['name' => 'create.clients', 'description' => 'Crear clientes']);
        Permission::create(['name' => 'edit.clients', 'description' => 'Editar clientes']);
        Permission::create(['name' => 'delete.clients', 'description' => 'Eliminar clientes']);

        Permission::create(['name' => 'view.purchases', 'description' => 'Ver compras']);
        Permission::create(['name' => 'create.purchases', 'description' => 'Crear compras']);
        Permission::create(['name' => 'edit.purchases', 'description' => 'Editar compras']);
        Permission::create(['name' => 'delete.purchases', 'description' => 'Eliminar compras']);

        Permission::create(['name' => 'view.inventory', 'description' => 'Ver inventario']);
        Permission::create(['name' => 'manage.inventory', 'description' => 'Gestionar inventario']);

        Permission::create(['name' => 'view.modules', 'description' => 'Ver módulos']);
        Permission::create(['name' => 'manage.modules', 'description' => 'Gestionar módulos']);

        Permission::create(['name' => 'view.products', 'description' => 'Ver productos']);
        Permission::create(['name' => 'create.products', 'description' => 'Crear productos']);
        Permission::create(['name' => 'edit.products', 'description' => 'Editar productos']);
        Permission::create(['name' => 'delete.products', 'description' => 'Eliminar productos']);

        Permission::create(['name' => 'view.suppliers', 'description' => 'Ver proveedores']);
        Permission::create(['name' => 'create.suppliers', 'description' => 'Crear proveedores']);
        Permission::create(['name' => 'edit.suppliers', 'description' => 'Editar proveedores']);
        Permission::create(['name' => 'delete.suppliers', 'description' => 'Eliminar proveedores']);

        Permission::create(['name' => 'view.transactions', 'description' => 'Ver transacciones']);
        Permission::create(['name' => 'create.transactions', 'description' => 'Crear transacciones']);
        Permission::create(['name' => 'edit.transactions', 'description' => 'Editar transacciones']);
        Permission::create(['name' => 'delete.transactions', 'description' => 'Eliminar transacciones']);

        Permission::create(['name' => 'view.audits', 'description' => 'Ver auditorías']);

        Permission::create(['name' => 'view.about', 'description' => 'Ver Acerca de Nosotros']);

        // Crear roles y asignar permisos
        $admin = Role::create(['name' => 'admin', 'description' => 'Encargado de administrar todo']);
        $admin->givePermissionTo(Permission::all());

        $vendedor = Role::create(['name' => 'vendedor', 'description' => 'Encargado de ventas']);
        $vendedor->givePermissionTo([
            'view.home',
            'view.products',
            'view.clients',
            'create.clients',
            'edit.clients',
            'view.transactions',
            'create.transactions',
            'view.inventory',
            'view.profile',
            'view.about',
        ]);

        $gerente = Role::create(['name' => 'gerente', 'description' => 'Encargado de ventas, compras, empleados']);
        $gerente->givePermissionTo([
            'view.home',
            'view.roles',
            'create.roles',
            'edit.roles',
            'delete.roles',
            'view.products',
            'view.categories',
            'view.clients',
            'view.purchases',
            'view.inventory',
            'view.modules',
            'view.suppliers',
            'create.suppliers',
            'edit.suppliers',
            'delete.suppliers',
            'create.transactions',
            'edit.transactions',
            'view.transactions',
            'delete.transactions',
            'view.profile',
            'view.audits',
            'view.about',
        ]);

        $compras = Role::create(['name' => 'compras', 'description' => 'Encargado de compras']);
        $compras->givePermissionTo([
            'view.home',
            'view.products',
            'view.purchases',
            'create.purchases',
            'edit.purchases',
            'create.products',
            'edit.products',
            'view.suppliers',
            'create.suppliers',
            'edit.suppliers',
            'view.profile',
            'view.inventory',
            'view.about',
        ]);

        $inventario = Role::create(['name' => 'inventario', 'description' => 'Encargado del inventario']);
        $inventario->givePermissionTo([
            'view.home',
            'view.inventory',
            'manage.inventory',
            'view.products',
            'edit.products',
            'view.purchases',
            'view.profile',
            'view.categories',
            'create.categories',
            'edit.categories',
            'delete.categories',
            'view.about',
        ]);

        $cliente = Role::create(['name' => 'cliente', 'description' => 'Cliente de la ferretería']);
        $cliente->givePermissionTo([
            'view.home',
            'view.profile',
            'view.products',
            'view.about',
        ]);
    }
}
