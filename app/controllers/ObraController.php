<?php
class ObraController extends BaseController {

public function mostrar(){

	//$obras = Obra::find(1);
	//echo Session::get("proyecto")->id;
	$obras = Obra::where('proyecto_id','=',Session::get("proyecto")->id)->get();

	return View::make("obras.lista", array("obras"=>$obras));

}

public function nuevo(){

	$proyectos = Proyecto::all()->lists("nombre","id");
	$selected = array();
	return View::make("obras.crear", compact('proyectos', 'selected'));
	//return "ho";
}

public function nuevo2(){

	 $obras = Obra::create(Input::all());


	$obras->save();


	return Redirect::to("obras");

}




}