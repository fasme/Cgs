<?php
class PartidacategoriaController extends BaseController {

public function mostrar(){

	//$partidacategorias = Partidacategoria::all();
	$partidacategorias = Partidacategoria::where('proyecto_id','=',Session::get("proyecto")->id)->get();
	return View::make("partidacategorias.lista", array("partidacategorias"=>$partidacategorias));

}

public function nuevo(){

	$partidacategoria = new Partidacategoria;
	//$categorias = Partidacategoriacategoria::all()->lists("nombre","id");


	return View::make("partidacategorias.crear")->with("obras",$obras)->with("categorias",$categorias)->with("partidacategoria",$partidacategoria);
	
}


public function nuevo2(){

	//$partidacategoria = Partidacategoria::Create(Input::all());
	//
		

	 $data = Input::all();
	$partidacategoria = new Partidacategoria;
	$data["obra_id"] = $data["partidaid"];
	$data["proyecto_id"] = Session::get("proyecto")->id;

	
		$partidacategoria->fill($data);
		$partidacategoria->save();
		return Redirect::to('partidas/nuevo');
	}
	
}





