<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoria1 = new Categoria();
        $categoria1->nombre_categoria = "Herramientas manuales";
        $categoria1->descripcion_categoria = "Herramientas manuales";
        $categoria1->save();

        $categoria2 = new Categoria();
        $categoria2->nombre_categoria = "Herramientas eléctricas";
        $categoria2->descripcion_categoria = "Herramientas eléctricas";
        $categoria2->save();

        $categoria3 = new Categoria();
        $categoria3->nombre_categoria = "Materiales de construcción";
        $categoria3->descripcion_categoria = "Materiales de construcción";
        $categoria3->save();

        $categoria4 = new Categoria();
        $categoria4->nombre_categoria = "Pinturas y accesorios";
        $categoria4->descripcion_categoria = "Pinturas y accesorios";
        $categoria4->save();

        $categoria5 = new Categoria();
        $categoria5->nombre_categoria = "Plomería";
        $categoria5->descripcion_categoria = "Plomería";
        $categoria5->save();

        $categoria6 = new Categoria();
        $categoria6->nombre_categoria = "Cerrajería y seguridad";
        $categoria6->descripcion_categoria = "Cerrajería y seguridad";
        $categoria6->save();

        $categoria7 = new Categoria();
        $categoria7->nombre_categoria = "Jardinería";
        $categoria7->descripcion_categoria = "Jardinería";
        $categoria7->save();

        $categoria8 = new Categoria();
        $categoria8->nombre_categoria = "Fijaciones y tornillería";
        $categoria8->descripcion_categoria = "Fijaciones y tornillería";
        $categoria8->save();

        $categoria9 = new Categoria();
        $categoria9->nombre_categoria = "Adhesivos y selladores";
        $categoria9->descripcion_categoria = "Adhesivos y selladores";
        $categoria9->save();
    }
}
