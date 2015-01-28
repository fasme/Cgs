<?php
class ObraController extends BaseController {

public function mostrar(){

	//$obras = Obra::find(1);
	//echo Session::get("proyecto")->id;
	
	$obras = Obra::where('proyecto_id','=',Session::get("proyecto")->id)->get();

	return View::make("obras.lista")->with("obras",$obras);

}

public function nuevo(){

	$obra = new Obra;
	$proyectos = Proyecto::all()->lists("nombre","id");
	$selected = array();
	return View::make("obras.crear")->with("obra",$obra);
	//return "ho";
}

public function nuevo2(){

	 $obras = Obra::create(Input::all());


	$obras->save();


	return Redirect::to("obras");

}


public function editar($id){

	$obra = Obra::find($id);
	$proyectos = Proyecto::all()->lists("nombre","id");
	$selected = array();
	return View::make("obras.crear")->with("proyectos",$proyectos)->with("obra",$obra);

}

public function editar2($id){

$obra = Obra::find($id);
 $data = Input::all();
 $obra->fill($data);
 $obra->save();
 return Redirect::to("obras");
}


public function eliminar(){

	$id = Input::get("id");
	$obra = Obra::find($id);
	$obra->delete();
}

}