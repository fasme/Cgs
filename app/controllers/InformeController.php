<?php
class InformeController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
public function lista(){

    return View::make('informe.lista');
}
    public function analisisCostoDetalle()
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
//->where("obra_id","=","2")
//->where("controlgastogg","=","")
->groupBy('ggcategoria.id')
->select(DB::raw("*,SUM(DISTINCT(precio*cantidad)) as valorneto,SUM(DISTINCT(neto*1.19)) as valorneto2"))
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
->leftJoin("controlgasto","controlgasto.proyecto_id","=","proyecto.id")

//->leftJoin("ggcategoria","ggcategoria.id", "=", "gg.ggcategoria_id" )
//->leftJoin("controlgastogg","controlgastogg.ggcategoria_id", "=", "ggcategoria.id")
//->leftJoin("controlgasto","controlgasto.id", "=", "controlgastogg.controlgasto_id")
->where("proyecto.id","=", Session::get("proyecto")->id)
->where("controlgasto.concepto","=","GG")
//->where("obra_id","=","2")
//->groupBy('ggcategoria.id')
->select(DB::raw("*,SUM(DISTINCT(precio*cantidad)) as valorneto,SUM(DISTINCT(neto*1.19)) as valorneto2"))
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


   




}



?>