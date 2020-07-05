<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\SubCategoria;
use App\UnidadMedida;
use App\Producto;
class SubidaProductos extends Model  implements ToCollection
{
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function collection(Collection $rows)
    {
        // $rows [$i][0] ->Producto
        // $rows [$i][1] ->Marca o descripcion
        // $rows [$i][2] ->Precio
        // $rows [$i][3] ->Unidad
        // $rows [$i][4] ->Subcategoria
        // $rows [$i][5] ->Categoria
        // $rows [$i][6] ->Imagen
        for ($i=1; $i < count($rows) ; $i++) { 
            $categoria     = DB::table('categorias')
                            ->select('categorias.id','categorias.nombre')
                            ->where('nombre',trim($rows [$i][5]))->first();
            // SUBCATEGORIA
            $id_subca;
            $subcategoria   = DB::table('subcategorias')
                            ->select('subcategorias.id')
                            ->where('id_categoria','=',$categoria->id)
                            ->where('nombre','=',trim($rows [$i][4]))
                            ->first();
            if(isset($subcategoria->id)){
                $id_subca=$subcategoria->id;
            }else{
                $resultado=SubCategoria::create([
                    'nombre'       => $rows [$i][4] ,
                    'id_categoria' => $categoria->id
                ]);
                $id_subca=$resultado->id;
            }
            //UNIDADES DE MEDIDA
            $id_unidades;
            $unidad   = DB::table('unidades_medidas')
                            ->select('unidades_medidas.id')
                            ->where('nombre',$rows[$i][3])->first();
            if(isset($unidad->id)){
                $id_unidades=$unidad->id;
            }else{
                $resultado=UnidadMedida::create([
                    'nombre'       => $rows [$i][3] ,
                ]);
                $id_unidades=$resultado->id;
            }
            //PRODUCTOS
            Producto::create([
                'nombre'       => $rows [$i][0] ,
                'descripcion' =>$rows [$i][1],
                'precio' =>$rows [$i][2],
                'id_subcategoria' =>$id_subca,
                'id_und_medida' =>$id_unidades,
                'foto'          =>$rows [$i][6]
            ]);
        }
    }
}
