<?php
class ApuController extends BaseController {


public function mostrar(){

$apus = Apu::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('apu.lista', array('apus' => $apus));

}


public function nuevo()
{

	$partidas = Partida::all()->lists("nombre","id");
	$selected = array();
 return View::make('apu.crear', compact('partidas','selected'));
}


public function nuevo2()
{

	
	
if (Input::has("nombremaquinaria"))
{


	$quantities = Input::get('nombremaquinaria');
foreach($quantities as $key=>$value) {

$apu = new Apu;
	 $data = array("partida_id"=>Input::get("partida_id"),"nombre"=>Input::get("nombremaquinaria.$key"),"unidad"=>Input::get("unidadmaquinaria.$key"),"preciou"=>Input::get("precioumaquinaria.$key"),"cantidad"=>Input::get("cantidadmaquinaria.$key"),"rend"=>Input::get("rendimientomaquinaria.$key"),"costo"=>Input::get("costomaquinaria.$key"),"proyecto_id"=>Session::get("proyecto")->id,"categoria"=>1);
	 print_r($data);
    $apu->fill($data);
    $apu->save();
}

}


 if (Input::has("nombrematerial"))
{

	$quantities = Input::get('nombrematerial');
foreach($quantities as $key=>$value) {

$apu = new Apu;
	 $data = array("partida_id"=>Input::get("partida_id"),"nombre"=>Input::get("nombrematerial.$key"),"unidad"=>Input::get("unidadmaterial.$key"),"preciou"=>Input::get("precioumaterial.$key"),"cantidad"=>Input::get("cantidadmaterial.$key"),"rend"=>Input::get("rendimientomaterial.$key"),"costo"=>Input::get("costomaterial.$key"),"proyecto_id"=>Session::get("proyecto")->id,"categoria"=>2);
	 print_r($data);
    $apu->fill($data);
    $apu->save();
}

}



if (Input::has("nombremanoobra"))
{

	$quantities = Input::get('nombremanoobra');
foreach($quantities as $key=>$value) {

$apu = new Apu;
	 $data = array("partida_id"=>Input::get("partida_id"),"nombre"=>Input::get("nombremanoobra.$key"),"unidad"=>Input::get("unidadmanoobra.$key"),"preciou"=>Input::get("precioumanoobra.$key"),"cantidad"=>Input::get("cantidadmanoobra.$key"),"rend"=>Input::get("rendimientomanoobra.$key"),"costo"=>Input::get("costomanoobra.$key"),"proyecto_id"=>Session::get("proyecto")->id,"categoria"=>3);
	 print_r($data);
    $apu->fill($data);
    $apu->save();
}
}


return Redirect::to("apu");
	



}



public function editar($id){


	$partidas = Partida::all()->lists("nombre","id");
	$selected = array();
 return View::make('apu.editar')->with("partidas",$partidas);

}


public function editar2($id){


}


public function eliminar(){

	$id = Input::get("id");
	$apu = Apu::find($id);
	$apu->delete();
}

public function buscarPartidas()
{
	$id = Input::get("option");
	$partida = Partida::find($id);

	return $partida->cantidad;
}




}

?>