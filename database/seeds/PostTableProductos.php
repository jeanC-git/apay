<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PostTableProductos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('categorias')->insert([
                ['nombre' => 'Verduras'],
                ['nombre' => 'Frutas'],
                ['nombre' => 'Carnes'],
                ['nombre' => 'Marinos'],
                ['nombre' => 'Abarrotes'],
            ]);
            $categorias = DB::table('categorias')->get();

            foreach ($categorias as $categoria) {
                DB::table('subcategorias')->insert([
                    ['nombre'       => 'Otros',
                    'id_categoria'  => $categoria->id],
                ]);
            }

            $subcategoria=[
                ["nombre_categoria"=>'Abarrotes','nombre_subcategoria'=>'Aceites'],
                ["nombre_categoria"=>'Abarrotes','nombre_subcategoria'=>'Arroz'],
                ["nombre_categoria"=>'Abarrotes','nombre_subcategoria'=>'Alimentos en conserva'],
                ["nombre_categoria"=>'Abarrotes','nombre_subcategoria'=>'Menestras'],
                ["nombre_categoria"=>'Abarrotes','nombre_subcategoria'=>'Condimentos, Vinagres y Comida Instantánea'],
                ["nombre_categoria"=>'Abarrotes','nombre_subcategoria'=>'Fideos, Pastas y Salsas'],
                ["nombre_categoria"=>'Abarrotes','nombre_subcategoria'=>'Reposteria'],
                ["nombre_categoria"=>'Abarrotes','nombre_subcategoria'=>'Chocolateria'],
                ["nombre_categoria"=>'Abarrotes','nombre_subcategoria'=>'Galletas, Snacks y Golosinas'],
                ["nombre_categoria"=>'Abarrotes','nombre_subcategoria'=>'Chocolateria'],
                ["nombre_categoria"=>'Carnes','nombre_subcategoria'=>'Pollo'],
                ["nombre_categoria"=>'Carnes','nombre_subcategoria'=>'Res'],
                ["nombre_categoria"=>'Carnes','nombre_subcategoria'=>'Chancho'],
                ["nombre_categoria"=>'Marinos','nombre_subcategoria'=>'Pescados'],
                ["nombre_categoria"=>'Marinos','nombre_subcategoria'=>'Marisco'],
            ];
            foreach ($subcategoria as $value) {
                $id_categoria=DB::table('categorias')->select('categorias.id')->where('nombre',$value["nombre_categoria"])->first();
                DB::table('subcategorias')->insert([
                    ['nombre'       => $value["nombre_subcategoria"],
                    'id_categoria'  => $id_categoria->id],
                ]);
            }

    }
}
