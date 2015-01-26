<?php
class ApuController extends BaseController {


public function mostrar(){

$usuarios = Apu::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('apu.lista', array('usuarios' => $usuarios));

}


public function nuevo()
{

	$partidas = Partida::all()->lists("nombre","id");
	$selected = array();
 return View::make('apu.crear', compact('partidas','selected'));
}


public function nuevo2()
{

}




}

?>