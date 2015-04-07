<?php
class ControlingresoController extends BaseController {


public function mostrar(){

$controlingresos = Controlingreso::where("proyecto_id",'=',Session::get("proyecto")->id)->get();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('controlingreso.lista', array('controlingresos' => $controlingresos));

}


public function nuevo()
{




    $controlingreso = new Controlingreso;
	$proyectos = Proyecto::all()->lists("nombre","id");
	$selected = array();

  $obras0 = array("0"=>"-- seleccione Obra --");
    $obras = Obra::Where("proyecto_id","=",Session::get("proyecto")->id)->lists("nombre","id");
 
    $obras = $obras0 + $obras;
 // array_unshift($obras, ' --- Seleccione una obra --- ');
    $selected2 = array();

  


 //return View::make('controlgasto.crear', compact('proyectos','selected'), compact('obras','selected2'), compact('ggs','selected3'));
    return View::make('controlingreso.formulario')->with("controlingreso",$controlingreso)->with('proyectos',$proyectos)->with('obras',$obras);
}


public function nuevo2()
{

    $controlingreso = new Controlingreso;
    $data = Input::all();
  // return $data;

    if($controlingreso->isValid($data))
    {
         list($dia,$mes,$ano) = explode("/",$data['fecha']);
            $data['fecha'] = "$ano-$mes-$dia";
            
        $controlingreso->fill($data);

        $controlingreso->save();
         $lastid =  $controlingreso->id;

        return Redirect::to('controlingreso');
    }
     else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::to('controlingreso/nuevo')->withInput()->withErrors($controlingreso->errors);
            //return "mal2";
        }



            


    

    
   



}


public function editar($id)
{

    $controlingreso = Controlingreso::find($id);

    $proyectos = Proyecto::all()->lists("nombre","id");
    $selected = array();

    $obras0 = array("0"=>"-- Seleccione obra --");
    $obras = Obra::Where("proyecto_id","=",Session::get("proyecto")->id)->lists("nombre","id");
  //array_unshift($obras, ' --- Seleccione una obra --- ');
    $obras = $obras0 + $obras;
    $selected2 = array();




//array_unshift($ggs, ' --- Seleccione una categoria --- ');
    $selected3 = array();

return View::make('controlingreso.formulario')->with("controlingreso",$controlingreso)->with('proyectos',$proyectos)->with('obras',$obras);


}

public function editar2($id)
{

    $controlingreso = Controlingreso::find($id);
    $data = Input::all();

    list($dia,$mes,$ano) = explode("/",$data['fecha']);
            $data['fecha'] = "$ano-$mes-$dia";
    
    $controlingreso->fill($data);
    $controlingreso->save();




     return Redirect::to('controlingreso');



}




public function eliminar()
{
    $id = Input::get("id");
    $controlingreso = Controlingreso::find($id);
    $controlingreso->delete();
    return "o";

}






}

?>