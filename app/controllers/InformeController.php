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


$sql1 = Controlgasto::where('proyecto_id',"=",Session::get("proyecto")->id)->where('concepto',"=","GG")->select(DB::raw("SUM(neto) as valorneto2"))->get();



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
    ->select(DB::raw("SUM(controlgasto.neto) as valorneto"))
     ->groupBy('ggcategoria.id')
    ->get();


     //return $sql2;

      return View::make('informe.analisiscostodetalle')->with("categorias",$sql)->with("teorico", $sql1)->with("real",$sql2);

    }


    public function analisisCostoResumenMensual()
    {

      $sql = Gastogeneral::where("proyecto_id","=", Session::get("proyecto")->id)->select(DB::raw("*, SUM(precio*cantidad) as valorneto"))->get();
      
     $sql1 = Controlgasto::where('proyecto_id',"=",Session::get("proyecto")->id)->where('concepto',"=","GG")->select(DB::raw("extract(month from fecha) as mes,extract(year from fecha) as ano,SUM(neto) as valorneto2"))->groupby("mes")->groupBy("ano")->orderby("ano")->get();

     
return View::make('informe.analisiscostoresumenmensual')->with("teorico", $sql)->with("real",$sql1);


     


    }





















    public function cdExcavacion($obra){

       $ids = array("6","31","62","83","8","32","63","84"); 
       $sql = Partida::leftjoin("apu","apu.partida_id","=","partida.id")
       ->select(DB::raw("SUM((apu.cantidad * apu.preciou * (1/partida.cantidad))*partida.cantidad) as suma"))
       ->Wherein("partida.id",$ids);

       if($obra != "ALL")
       {
        $sql = $sql->where("obra_id","=",$obra);
        $sql = $sql->get();
       }
       else
       {
         $sql = $sql->get();
       }

      

       //$sql = Partida::whereIn("id", $ids)->where("proyecto_id","=",Session::get("proyecto")->id)->get();
    

       $sql1 = Controlgasto::leftjoin("controlgastocd","controlgastocd.controlgasto_id","=","controlgasto.id")
       ->select(DB::raw("SUM(controlgasto.neto) as suma2"))
      // ->where("controlgasto.obra_id","=",$obra)
        ->Wherein("controlgastocd.partida_id",$ids);

         if($obra != "ALL")
       {
        $sql1 = $sql1->where("controlgasto.obra_id","=",$obra);
        $sql1 = $sql1->get();
       }
       else
       {
         $sql1 = $sql1->get();
       }

       

       

       $titulo = "Excavaciones";
       return View::make('informe.analisiscd')->with("teorico", $sql)->with("real",$sql1)->with("titulo",$titulo);


    }


    public function cdRellenos($obra){

      $ids = array("19","37","71","89"); 
      $sql = Partida::leftjoin("apu","apu.partida_id","=","partida.id")
       ->select(DB::raw("SUM((apu.cantidad * apu.preciou * (1/partida.cantidad))*partida.cantidad) as suma"))
       ->Wherein("partida.id",$ids);

       if($obra != "ALL")
       {
        $sql = $sql->where("obra_id","=",$obra);
        $sql = $sql->get();
       }
       else
       {
         $sql = $sql->get();
       }

      

       //$sql = Partida::whereIn("id", $ids)->where("proyecto_id","=",Session::get("proyecto")->id)->get();
    

       $sql1 = Controlgasto::leftjoin("controlgastocd","controlgastocd.controlgasto_id","=","controlgasto.id")
       ->select(DB::raw("SUM(controlgasto.neto) as suma2"))
      // ->where("controlgasto.obra_id","=",$obra)
        ->Wherein("controlgastocd.partida_id",$ids);

         if($obra != "ALL")
       {
        $sql1 = $sql1->where("controlgasto.obra_id","=",$obra);
        $sql1 = $sql1->get();
       }
       else
       {
         $sql1 = $sql1->get();
       }


       

       $titulo = "Rellenos Estructurales";
       return View::make('informe.analisiscd')->with("teorico", $sql)->with("real",$sql1)->with("titulo",$titulo);

    }

    public function cdHormigon($obra){
      $ids = array("27","48","79","100","15","40","70","92","12","36","67","88","30","51","82","103","55","107","23","44","75","96","9","20","24","28","33","41","45","49","64","72","76","80","85","93","97","101"); 
       $sql = Partida::leftjoin("apu","apu.partida_id","=","partida.id")
       ->select(DB::raw("SUM((apu.cantidad * apu.preciou * (1/partida.cantidad))*partida.cantidad) as suma"))
       ->Wherein("partida.id",$ids);

       if($obra != "ALL")
       {
        $sql = $sql->where("obra_id","=",$obra);
        $sql = $sql->get();
       }
       else
       {
         $sql = $sql->get();
       }

      

       //$sql = Partida::whereIn("id", $ids)->where("proyecto_id","=",Session::get("proyecto")->id)->get();
    

       $sql1 = Controlgasto::leftjoin("controlgastocd","controlgastocd.controlgasto_id","=","controlgasto.id")
       ->select(DB::raw("SUM(controlgasto.neto) as suma2"))
      // ->where("controlgasto.obra_id","=",$obra)
        ->Wherein("controlgastocd.partida_id",$ids);

         if($obra != "ALL")
       {
        $sql1 = $sql1->where("controlgasto.obra_id","=",$obra);
        $sql1 = $sql1->get();
       }
       else
       {
         $sql1 = $sql1->get();
       }


       

       $titulo = "Hormigon";
       return View::make('informe.analisiscd')->with("teorico", $sql)->with("real",$sql1)->with("titulo",$titulo);

    }


    public function cdAcero($obra){
      $ids = array("10","13","21","25","29","34","38","42","46","50","54","65","68","73","77","81","86","90","94","98","102","106"); 
      $sql = Partida::leftjoin("apu","apu.partida_id","=","partida.id")
       ->select(DB::raw("SUM((apu.cantidad * apu.preciou * (1/partida.cantidad))*partida.cantidad) as suma"))
       ->Wherein("partida.id",$ids);

       if($obra != "ALL")
       {
        $sql = $sql->where("obra_id","=",$obra);
        $sql = $sql->get();
       }
       else
       {
         $sql = $sql->get();
       }

      

       //$sql = Partida::whereIn("id", $ids)->where("proyecto_id","=",Session::get("proyecto")->id)->get();
    

       $sql1 = Controlgasto::leftjoin("controlgastocd","controlgastocd.controlgasto_id","=","controlgasto.id")
       ->select(DB::raw("SUM(controlgasto.neto) as suma2"))
      // ->where("controlgasto.obra_id","=",$obra)
        ->Wherein("controlgastocd.partida_id",$ids);

         if($obra != "ALL")
       {
        $sql1 = $sql1->where("controlgasto.obra_id","=",$obra);
        $sql1 = $sql1->get();
       }
       else
       {
         $sql1 = $sql1->get();
       }

       

       $titulo = "Acero";
       return View::make('informe.analisiscd')->with("teorico", $sql)->with("real",$sql1)->with("titulo",$titulo);

    }


    public function cdMoldaje($obra){
      $ids = array("11","14","22","26","35","39","43","47","53","66","69","74","78","87","91","95","99","105"); 
      $sql = Partida::leftjoin("apu","apu.partida_id","=","partida.id")
       ->select(DB::raw("SUM((apu.cantidad * apu.preciou * (1/partida.cantidad))*partida.cantidad) as suma"))
       ->Wherein("partida.id",$ids);

       if($obra != "ALL")
       {
        $sql = $sql->where("obra_id","=",$obra);
        $sql = $sql->get();
       }
       else
       {
         $sql = $sql->get();
       }

      

       //$sql = Partida::whereIn("id", $ids)->where("proyecto_id","=",Session::get("proyecto")->id)->get();
    

       $sql1 = Controlgasto::leftjoin("controlgastocd","controlgastocd.controlgasto_id","=","controlgasto.id")
       ->select(DB::raw("SUM(controlgasto.neto) as suma2"))
      // ->where("controlgasto.obra_id","=",$obra)
        ->Wherein("controlgastocd.partida_id",$ids);

         if($obra != "ALL")
       {
        $sql1 = $sql1->where("controlgasto.obra_id","=",$obra);
        $sql1 = $sql1->get();
       }
       else
       {
         $sql1 = $sql1->get();
       }

       

       $titulo = "Moldaje";
       return View::make('informe.analisiscd')->with("teorico", $sql)->with("real",$sql1)->with("titulo",$titulo);

    }

    public function cdEnrocado($obra){
      $ids = array("56","57","58","108","109","110"); 
      $sql = Partida::leftjoin("apu","apu.partida_id","=","partida.id")
       ->select(DB::raw("SUM((apu.cantidad * apu.preciou * (1/partida.cantidad))*partida.cantidad) as suma"))
       ->Wherein("partida.id",$ids);

       if($obra != "ALL")
       {
        $sql = $sql->where("obra_id","=",$obra);
        $sql = $sql->get();
       }
       else
       {
         $sql = $sql->get();
       }

      

       //$sql = Partida::whereIn("id", $ids)->where("proyecto_id","=",Session::get("proyecto")->id)->get();
    

       $sql1 = Controlgasto::leftjoin("controlgastocd","controlgastocd.controlgasto_id","=","controlgasto.id")
       ->select(DB::raw("SUM(controlgasto.neto) as suma2"))
      // ->where("controlgasto.obra_id","=",$obra)
        ->Wherein("controlgastocd.partida_id",$ids);

         if($obra != "ALL")
       {
        $sql1 = $sql1->where("controlgasto.obra_id","=",$obra);
        $sql1 = $sql1->get();
       }
       else
       {
         $sql1 = $sql1->get();
       }


       

       $titulo = "Enrocados";
       return View::make('informe.analisiscd')->with("teorico", $sql)->with("real",$sql1)->with("titulo",$titulo);

    }


    public function cdOtros($obra){
      $ids = array("52","104","59","111","60","112"); 
      $sql = Partida::leftjoin("apu","apu.partida_id","=","partida.id")
       ->select(DB::raw("SUM((apu.cantidad * apu.preciou * (1/partida.cantidad))*partida.cantidad) as suma"))
       ->Wherein("partida.id",$ids);

       if($obra != "ALL")
       {
        $sql = $sql->where("obra_id","=",$obra);
        $sql = $sql->get();
       }
       else
       {
         $sql = $sql->get();
       }

      

       //$sql = Partida::whereIn("id", $ids)->where("proyecto_id","=",Session::get("proyecto")->id)->get();
    

       $sql1 = Controlgasto::leftjoin("controlgastocd","controlgastocd.controlgasto_id","=","controlgasto.id")
       ->select(DB::raw("SUM(controlgasto.neto) as suma2"))
      // ->where("controlgasto.obra_id","=",$obra)
        ->Wherein("controlgastocd.partida_id",$ids);

         if($obra != "ALL")
       {
        $sql1 = $sql1->where("controlgasto.obra_id","=",$obra);
        $sql1 = $sql1->get();
       }
       else
       {
         $sql1 = $sql1->get();
       }

       

       $titulo = "Otros";
       return View::make('informe.analisiscd')->with("teorico", $sql)->with("real",$sql1)->with("titulo",$titulo);

    }





    //  Presupuesto vs ingresos vs costos

    public function ingresoGasto($obra){


    
      $sql = Partida::leftjoin("apu","apu.partida_id","=","partida.id")
       ->select(DB::raw("SUM((apu.cantidad * apu.preciou * (1/partida.cantidad))*partida.cantidad) as suma"));
     

       if($obra != "ALL")
       {
        $sql = $sql->where("obra_id","=",$obra);
        $sql = $sql->get();
       }
       else
       {
         $sql = $sql->get();
       }

      

       //$sql = Partida::whereIn("id", $ids)->where("proyecto_id","=",Session::get("proyecto")->id)->get();
    

       $sql1 = Controlgasto::leftjoin("controlgastocd","controlgastocd.controlgasto_id","=","controlgasto.id")
       ->select(DB::raw("SUM(controlgasto.neto) as suma2"));
      // ->where("controlgasto.obra_id","=",$obra)
      

         if($obra != "ALL")
       {
        $sql1 = $sql1->where("controlgasto.obra_id","=",$obra);
        $sql1 = $sql1->get();
       }
       else
       {
         $sql1 = $sql1->get();
       }


        $sql2 = Controlingreso::select(DB::raw("SUM(neto) as suma3"));
      // ->where("controlgasto.obra_id","=",$obra)
      

         if($obra != "ALL")
       {
        $sql2 = $sql2->where("controlgasto.obra_id","=",$obra);
        $sql2 = $sql2->get();
       }
       else
       {
         $sql2 = $sql2->get();
       }

       

       $titulo = "Otros";
       return View::make('informe.analisisingresogasto')->with("teorico", $sql)->with("real",$sql1)->with("titulo",$titulo)->with("ingreso",$sql2);



    }


}





?>