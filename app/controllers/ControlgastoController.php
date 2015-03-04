<?php
class ControlgastoController extends BaseController {


public function mostrar(){

$controlgastos = Controlgasto::where("proyecto_id",'=',Session::get("proyecto")->id)->get();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('controlgasto.lista', array('controlgastos' => $controlgastos));

}


public function nuevo()
{

    $controlgasto = new Controlgasto;
	$proyectos = Proyecto::all()->lists("nombre","id");
	$selected = array();

    $obras = Obra::Where("proyecto_id","=",Session::get("proyecto")->id)->lists("nombre","id");
  array_unshift($obras, ' --- Seleccione una obra --- ');
    $selected2 = array();

    $partidas = Partida::Where("proyecto_id","=",Session::get("proyecto")->id)->lists("nombre","id");
    array_unshift($partidas, ' --- Seleccione una partida --- ');

    $ggs = Ggcategoria::all()->lists("nombre","id");
array_unshift($ggs, ' --- Seleccione una categoria --- ');
    $selected3 = array();

 //return View::make('controlgasto.crear', compact('proyectos','selected'), compact('obras','selected2'), compact('ggs','selected3'));
    return View::make('controlgasto.formulario')->with("controlgasto",$controlgasto)->with('proyectos',$proyectos)->with('obras',$obras)->with('ggs',$ggs)->with("partidas",$partidas);
}


public function nuevo2()
{

    $controlgasto = new Controlgasto;
    $data = Input::all();
   //return $data;

    if($controlgasto->isValid($data))
    {
         list($dia,$mes,$ano) = explode("/",$data['fecha']);
            $data['fecha'] = "$ano-$mes-$dia";
            
        $controlgasto->fill($data);

        $controlgasto->save();
         $lastid =  $controlgasto->id;

        

    if($data["concepto"] == "GG")
    {
        Controlgastogg::create(array("controlgasto_id"=>$lastid,"ggcategoria_id"=>$data["ggcategoria_id"]));
       // echo "gg";
    }
    else if($data["concepto"] == "CD")
    {
        Controlgastocd::create(array("controlgasto_id"=>$lastid,"partida_id"=>$data["partida_id"]));
      //  echo "cd";
    }



    // 1 Efectivo, 2 Cheque
    if($data["tipopago"] == "2")
    {
//echo "CHEQUE";
        $cheque = new Cheque;
        if($cheque->isValid($data))
        {
            list($dia,$mes,$ano) = explode("/",$data['fechapago']);
            $data['fechapago'] = "$ano-$mes-$dia";

             $data["controlgasto_id"] = $lastid;
            $cheque->fill($data);
            $cheque->save();
     // $cheque = Cheque::create($data);
        }
        else
        {
            return Redirect::to('controlgasto/nuevo')->withInput()->withErrors($cheque->errors);
        }
        
 
    }


        return Redirect::to('controlgasto');
    }
     else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('controlgasto/nuevo')->withInput()->withErrors($controlgasto->errors);
            //return "mal2";
        }



            

            

   // $controlgastos = Controlgasto::create($data);

    

    
   



}


public function editar($id)
{

    $controlgasto = Controlgasto::find($id);

    $proyectos = Proyecto::all()->lists("nombre","id");
    $selected = array();

    $obras = Obra::Where("proyecto_id","=",Session::get("proyecto")->id)->lists("nombre","id");
  array_unshift($obras, ' --- Seleccione una obra --- ');
    $selected2 = array();

    $partidas = Partida::Where("proyecto_id","=",Session::get("proyecto")->id)->lists("nombre","id");
    array_unshift($partidas, ' --- Seleccione una partida --- ');

    $ggs = Ggcategoria::all()->lists("nombre","id");
array_unshift($ggs, ' --- Seleccione una categoria --- ');
    $selected3 = array();

return View::make('controlgasto.formulario')->with("controlgasto",$controlgasto)->with('proyectos',$proyectos)->with('obras',$obras)->with('ggs',$ggs)->with("partidas",$partidas);


}

public function editar2($id)
{

    $controlgasto = Controlgasto::find($id);
    $data = Input::all();

    list($dia,$mes,$ano) = explode("/",$data['fecha']);
            $data['fecha'] = "$ano-$mes-$dia";
    
    $controlgasto->fill($data);
    $controlgasto->save();



     if($data["concepto"] == "GG")
    {
         $controlgastogg = Controlgasto::find($id)->controlgastogg()->first();
       
       $controlgastogg = Controlgastogg::find($controlgastogg->id);
       $controlgastogg->fill($data);
       $controlgastogg->save();
      
    }
    else if($data["concepto"] == "CD")
    {
        $controlgastocd = Controlgasto::find($id)->controlgastocd()->first();
        $controlgastocd = Controlgastocd::find($controlgastocd->id);
        $controlgastocd->fill($data);
        $controlgastocd->save();
     
    }

     if($data["tipopago"] == "2")
    {
        list($dia,$mes,$ano) = explode("/",$data['fechapago']);
        $data['fechapago'] = "$ano-$mes-$dia";

        $cheque_id = $controlgasto->cheque->id;

        $cheque = Cheque::find($cheque_id);

        $cheque->fill($data);
        $cheque->save();

 
 
    }

     return Redirect::to('controlgasto');



}


public function buscarcategoriasgg()
{
    $id = Input::get("option");
    $categoriagg = Ggcategoria::find($id);

   // Gastogeneral::
    return $categoriagg->gastogeneral->lists("nombre");
}


public function eliminar()
{
    $id = Input::get("id");
    $controlgasto = Controlgasto::find($id);
    $controlgasto->delete();
    return "o";

}



public function informecontabilidad(){



    return View::make("controlgasto.informecontabilidad");


}

public function informecontabilidad2(){

    $data = Input::all();

    //return $data["desde"];


    

    



    $rules = array(
           "periodomes"=>"required"
    );
 
$validator = Validator::make($data, $rules);


if ( $validator->fails() ){

    return Redirect::to('controlgasto/informecontabilidad')->withInput()->withErrors($validator->errors());
}
else
{
 /* 
     list($dia,$mes,$ano) = explode("/",$data['desde']);
     $data['desde'] = "$ano-$mes-$dia";

     list($dia,$mes,$ano) = explode("/",$data['hasta']);

     $data['hasta'] = "$ano-$mes-$dia";
     *

    $controlgastos = Controlgasto::whereBetween('fecha', array($data["desde"], $data["hasta"]))
    ->where('documento',"=",2)
    ->get();
     $html =  View::make("controlgasto.informecontabilidadpdf")->with("controlgastos",$controlgastos);

      return PDF::load($html, 'A4', 'portrait')->show();
      */


      $controlgastos = Controlgasto::where('periodomes',"=", $data["periodomes"])
      ->where("periodoano","=",$data["periodoano"])
    ->where('documento',"=",2)
    ->where("proyecto_id","=",Session::get("proyecto")->id)
    ->get();
     $html =  View::make("controlgasto.informecontabilidadpdf")->with("controlgastos",$controlgastos)->with("mes",$data["periodomes"])->with("ano",$data["periodoano"]);

      return PDF::load($html, 'A4', 'portrait')->show();

}
      
}   



}

?>