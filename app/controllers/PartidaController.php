<?php
class PartidaController extends BaseController {

public function mostrar(){

	$partidas = Partida::all();
	//$partidas = Partida::where('proyecto_id','=',Session::get("proyecto")->id)->get();
	return View::make("partidas.lista", array("partidas"=>$partidas));

}

public function nuevo(){

	$partida = new Partida;
	$categorias = Partidacategoria::all()->lists("nombre","id");

	$obras = Obra::where('proyecto_id',"=",Session::get("proyecto")->id)->get()->lists("nombre","id");
	$selected = array();
	return View::make("partidas.crear")->with("obras",$obras)->with("categorias",$categorias)->with("partida",$partida);
	//return "ho";
}


public function nuevo2(){

	//$partida = Partida::Create(Input::all());
	//
	

	$data = Input::all();
	$partida = new Partida;

	if($partida->isValid($data))
	{
		$partida->fill($data);
		$partida->save();
		return Redirect::to('partidas/nuevo');
	}
	else
	{
		return Redirect::to('partidas/nuevo')->withInput()->withErrors($partida->errors);
	}
	
}


public function editar($id){

	$partida = Partida::find($id);

	$categorias = Partidacategoria::all()->lists("nombre","id");

	$obras = Obra::where('proyecto_id',"=",Session::get("proyecto")->id)->get()->lists("nombre","id");
	$selected = array();
	return View::make("partidas.crear")->with("obras",$obras)->with("categorias",$categorias)->with("partida",$partida);
	//return "ho";
}


public function editar2($id){


$data = Input::all();
	$partida = Partida::find($id);

	if($partida->isValid($data))
	{
		$partida->fill($data);
		$partida->save();
		return Redirect::to('partidas/nuevo');
	}
	else
	{
		return Redirect::to('partidas/nuevo')->withInput()->withErrors($partida->errors);
	}
}


public function eliminar(){

}



}