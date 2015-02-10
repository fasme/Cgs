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

 	return View::make('presupuesto.crear');
}


public function nuevo2()
{

	 $data = Input::all();

	 $proyecto = Proyecto::Where("proyecto.id","=",$data["proyecto_id"])->get();

	 //var_dump($proyecto);
	// echo count($proyecto);
	 return View::make('presupuesto.mostrar')->with("proyecto",$proyecto);
}




}

?>