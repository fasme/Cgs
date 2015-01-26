<?php
class PartidaController extends BaseController {

public function mostrarPartida(){

	$partidas = Partida::all();
	//$partidas = Partida::where('proyecto_id','=',Session::get("proyecto")->id)->get();
	return View::make("partidas.lista", array("partidas"=>$partidas));

}

public function nuevoPartida(){


	$categorias = Partidacategoria::all()->lists("nombre","id");

	$obras = Obra::where('proyecto_id',"=",Session::get("proyecto")->id)->get()->lists("nombre","id");
	$selected = array();
	return View::make("partidas.crear", compact('obras', 'selected'), compact('categorias','selected'));
	//return "ho";
}


public function crearPartida(){

	$partida = Partida::Create(Input::all());
	return Redirect::to('partidas/nuevo');
	//return Redirect::to('partidas/nuevo')->withInput()->withErrors($partida->errors);
}




}