<?php
class PresupuestoController extends BaseController {


public function mostrar(){

$usuarios = Presupuesto::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('presupuesto.lista', array('usuarios' => $usuarios));

}


public function nuevo()
{

	$proyectos = Proyecto::all()->lists("nombre","id");
	$selected = array();
 	return View::make('presupuesto.crear', compact('proyectos','selected'));
}


public function nuevo2()
{

}




}

?>