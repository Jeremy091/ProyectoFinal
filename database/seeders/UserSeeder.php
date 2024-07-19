<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user1 = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456789')
        ]);

        $user2 = User::create([
            'name' => 'vendedor',
            'email' => 'vendedor@gmail.com',
            'password' => bcrypt('123456789')
        ]);

        $user3 = User::create([
            'name' => 'gerente',
            'email' => 'gerente@gmail.com',
            'password' => bcrypt('123456789')
        ]);

        $user4 = User::create([
            'name' => 'compras',
            'email' => 'compras@gmail.com',
            'password' => bcrypt('123456789')
        ]);

        $user5 = User::create([
            'name' => 'inventario',
            'email' => 'inventario@gmail.com',
            'password' => bcrypt('123456789')
        ]);

        $user6 = User::create([
            'name' => 'cliente',
            'email' => 'cliente@gmail.com',
            'password' => bcrypt('123456789')
        ]);

        $user7 = User::create([
            'name' => 'juan',
            'email' => 'ulcuangoulcuango@gmail.com',
            'password' => bcrypt('123456789')
        ]);

        // Asigna el rol 'admin' al usuario recién creado
        $user1->syncRoles(['admin']);

        // Asigna el rol 'vendedor' al usuario recién creado
        $user2->syncRoles(['vendedor']);

        // Asigna el rol 'gerente' al usuario recién creado
        $user3->syncRoles(['gerente']);

        // Asigna el rol 'compras' al usuario recién creado
        $user4->syncRoles(['compras']);

        // Asigna el rol 'inventario' al usuario recién creado
        $user5->syncRoles(['inventario']);

        // Asigna el rol 'cliente' al usuario recién creado
        $user6->syncRoles(['cliente']);

        // Asigna el rol 'admin' al usuario recién creado
        $user7->syncRoles(['admin']);
    }
}
