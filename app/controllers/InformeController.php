<?php
class InformeController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
public function lista(){

    return View::make('informe.lista');
}





public function analisisCostoObra($obra)
    {
        


     /*   
          $gastogeneral = Ggcategoria::leftJoin("gg","gg.ggcategoria_id","=",'ggcategoria.id')

//->where('proyecto_id',"=",1)
//->orWhere('proyecto_id',"=",NULL)
->groupBy('ggcategoria.id')
//->groupBy('gg.proyecto_id')
->select(DB::raw('ggcategoria.nombre,sum(DISTINCT(cantidad*precio)) as valorneto'))

->get();

        $controlgasto = Ggcategoria::leftJoin("controlgasto","controlgasto.ggcategoria_id","=",'ggcategoria.id',"AND",'proyecto_id',"=",2)
//->where('proyecto_id',"=",1)
//->orWhere('proyecto_id',"=",NULL)
->groupBy('ggcategoria.id')
//->groupBy('controlgasto.proyecto_id')
->select(DB::raw('*,controlgasto.ggcategoria_id,sum(DISTINCT(neto*1.19)) as valorneto2'))

->get();
*/

$sql = Proyecto::leftJoin("gg","proyecto.id","=", "gg.proyecto_id")
->leftJoin("ggcategoria","ggcategoria.id", "=", "gg.ggcategoria_id" )
->leftJoin("controlgastogg","controlgastogg.ggcategoria_id", "=", "ggcategoria.id")
->leftJoin("controlgasto","controlgasto.id", "=", "controlgastogg.controlgasto_id")
->where("proyecto.id","=", Session::get("proyecto")->id)
->where("obra_id","=",$obra)
->where("controlgasto.concepto","=","GG")
->groupBy('ggcategoria.id')
->select(DB::raw("*,SUM(DISTINCT((precio*cantidad)/2)) as valorneto,SUM(DISTINCT((neto*1.19)/2)) as valorneto2"))
->get();


//print_r(DB::getQueryLog());
 //$gastogeneral = Gastogeneral::join("ggcategoria","gg.ggcategoria_id","=","ggcategoria.id","RIGHT")
//->get();



// array_push($controlgasto, "0");

//print_r($array);
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        //return $ordenes;
     return View::make('informe.analisiscosto')->with('teorico',$sql);
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }





    public function analisisCostoResumen()
    {
        



$sql = Gastogeneral::where("proyecto_id","=", Session::get("proyecto")->id)->select(DB::raw("*, SUM(precio*cantidad) as valorneto"))->get();


$sql1 = Controlgasto::where('proyecto_id',"=",Session::get("proyecto")->id)->where('concepto',"=","GG")->select(DB::raw("SUM(neto*1.19) as valorneto2"))->get();



     return View::make('informe.analisiscostoresumen')->with('teorico',$sql)->with("real",$sql1);
        

    }


    public function analisisCostoDetalle()
    {
        
      $sql = Ggcategoria::where("proyecto_id","=",Session::get("proyecto")->id)->get();

/*
     $sql1 = Gastogeneral::where("proyecto_id","=", Session::get("proyecto")->id)
     ->select(DB::raw("*, SUM(precio*cantidad) as valorneto"))
     ->groupBy('ggcategoria_id')
     ->get();
*/

    $sql1 = Ggcategoria::leftjoin("gg","ggcategoria.id","=","gg.ggcategoria_id")
     
     ->where("ggcategoria.proyecto_id","=", Session::get("proyecto")->id)
     ->select(DB::raw("SUM(precio*cantidad) as valorneto"))
     ->groupBy('ggcategoria.id')
    ->get();


    $sql2 = Ggcategoria::leftjoin("controlgastogg","ggcategoria.id","=","controlgastogg.ggcategoria_id")
    ->leftjoin("controlgasto","controlgasto.id","=","controlgastogg.controlgasto_id")
    ->where("ggcategoria.proyecto_id","=", Session::get("proyecto")->id)
    ->select(DB::raw("SUM(controlgasto.neto*1.19) as valorneto"))
     ->groupBy('ggcategoria.id')
    ->get();


     //return $sql2;

      return View::make('informe.analisiscostodetalle')->with("categorias",$sql)->with("teorico", $sql1)->with("real",$sql2);

    }


   




}



?>