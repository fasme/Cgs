<?php
class ApuController extends BaseController {


public function mostrar(){


$apus = Apu::where("proyecto_id",'=',Session::get("proyecto")->id)->get();

        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('apu.lista', array('apus' => $apus));

}


public function nuevo()
{


	//$partidas  = Partida::Where("proyecto_id","=",Session::get("proyecto")->id)->lists("nombre","id");
	$partidas = Array();
	$obras = Obra::Where("proyecto_id","=",Session::get("proyecto")->id)->lists("nombre","id");
	 array_unshift($obras, ' --- Seleccione una obra --- ');

 return View::make('apu.crear')->with("partidas",$partidas)->with("obras",$obras);
}


public function nuevo2()
{

	
	$data = Input::all();

	//print_r($data["apu"]);
	$arreglo = Array();
	//echo count($data["apu"]);

for($i=0;$i<count($data["apu"]);$i++)
{
	$apu = new Apu;
	if($data["apu"][$i]["nombre"] != "")
		
	if($apu->isValid($data["apu"][$i]))
	{

		echo $apu;
		
		array_push($arreglo, "valido");
	}
	else
	{
		echo $apu;
		array_push($arreglo, "invalido");
		return Redirect::to("apu/nuevo")->withInput()->withErrors($apu->errors);
	}

}



if(in_array("invalido", $arreglo))  // si existe invalido es error
{
	

}
else // si no existe guarda en la bd
{
	for($i=0;$i<count($data["apu"]);$i++)
	{
		$apu = new Apu;
		if($data["apu"][$i]["nombre"] != "")
		{
			

			$apu->fill(array("partida_id"=>$data["partida_id"],"nombre"=>$data["apu"][$i]["nombre"],"unidad"=>$data["apu"][$i]["nombre"],"preciou"=>$data["apu"][$i]["preciou"],"cantidad"=>$data["apu"][$i]["cantidad"],"rend"=>$data["apu"][$i]["rendimiento"],"costo"=>$data["apu"][$i]["costo"],"proyecto_id"=>Session::get("proyecto")->id,"categoria"=>$data["apu"][$i]["categoria"]));
			$apu->save();
		}
			


	}
	
	
	return Redirect::to("apu");
}




	


//return Redirect::to("apu");
	



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