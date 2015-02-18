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

 



    // Call writer methods here
$data = Input::all();

	


	 $proyectos = Proyecto::Where("proyecto.id","=",$data["proyecto_id"])->get();

	 echo "<table border=1 width='100%'>";
	 foreach ($proyectos as $proyecto) {
	 	echo "<tr><td colspan='5'>".$proyecto->nombre."</td></tr>";
	 	$obras = Obra::Where("proyecto_id","=",$proyecto->id)->get();

	 	foreach ($obras as $obra) {
	 		echo "<tr><td bgcolor='green' colspan='5'>".$obra->nombre."</td></tr>";
	 		$partidacategorias = Partidacategoria::Where("obra_id","=",$obra->id)->get();
	 		
	 		foreach ($partidacategorias as $partidacategoria) {

	 		echo "<tr><td bgcolor='yellow'>".$partidacategoria->nombre."</td></tr>";

	 			$partidas = Partida::Where("obra_id","=",$obra->id)->Where("categoria_id","=",$partidacategoria->id)->get();
	 			foreach ($partidas as $partida) {
	 				$suma =0; 
  foreach($partida->apu as $apu){
$suma += round($apu->cantidad*$apu->preciou*(1/$partida->cantidad)); 
}
    
   
	 				echo "<tr><td>".utf8_decode($partida->nombre)."</td><td>".$partida->unidad."</td><td>".number_format($partida->cantidad,3,",",".")."</td><td>".$suma."</td><td>".number_format($partida->cantidad*$suma,0,",",".")."</td></tr>";
	 			}
	 		
	 		}
	 	}
	 }

	 echo "</table>";
	 
	
	// return View::make('presupuesto.mostrar');





}




}

?>