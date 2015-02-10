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

	 $proyectos = Proyecto::Where("proyecto.id","=",$data["proyecto_id"])->get();

	 foreach ($proyectos as $proyecto) {
	 	echo $proyecto->nombre."<br>";
	 	$obras = Obra::Where("proyecto_id","=",$proyecto->id)->get();

	 	foreach ($obras as $obra) {
	 		echo $obra->nombre;
	 		$partidacategorias = Partidacategoria::Where("obra_id","=",$obra->id)->get();
	 		
	 		foreach ($partidacategorias as $partidacategoria) {

	 		echo $partidacategoria->nombre."<br>";

	 			$partidas = Partida::Where("obra_id","=",$obra->id)->get();
	 			foreach ($partidas as $partida) {
	 				echo $partida->nombre."<br>";
	 			}
	 		
	 		}
	 	}
	 }
	 //var_dump($proyecto);
	// echo count($proyecto);
	 return View::make('presupuesto.mostrar')->with("proyectos",$proyectos);
}




}

?>