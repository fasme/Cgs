<?php
class ApuController extends BaseController {


public function mostrar(){



 $partidas  = Partida::Where("proyecto_id","=",Session::get("proyecto")->id)->get();
     
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('apu.lista', array('partidas' => $partidas));

}


public function nuevo()
{


	$partidas  = Partida::Where("proyecto_id","=",Session::get("proyecto")->id)->lists("nombre","id");
	//$partidas = Array();
	$obras0 = Array("0"=>"seleccione");
	$obras = Obra::Where("proyecto_id","=",Session::get("proyecto")->id)->lists("nombre","id");
	$obras = $obras0 + $obras;
	// array_unshift($obras, ' --- Seleccione una obra --- ');

 return View::make('apu.crear')->with("partidas",$partidas)->with("obras",$obras);
}


public function nuevo2()
{

	
	$data = Input::all();

	
	$arreglo = Array();
	//echo count($data["apu"]);

for($i=0;$i<count($data["apu"]);$i++)
{
	$apu = new Apu;
	if($data["apu"][$i]["nombre"] != "")
	{
	
		$data["apu"][$i] = array_add($data["apu"][$i], 'cantidadpartida', $data["cantidadpartida"]);
		$data["apu"][$i] = array_add($data["apu"][$i], 'partida_id', $data["partida_id"]);
		$data["apu"][$i] = array_add($data["apu"][$i], 'obra_id', $data["obra_id"]);

		if($apu->isValid($data["apu"][$i]))
		{

		
			
			array_push($arreglo, "valido");
		}
		else
		{
			
			array_push($arreglo, "invalido");
			return Redirect::to("apu/nuevo")->withInput()->withErrors($apu->errors);
		}
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



		$partidas  = Partida::find($id);

	//$partidas = Array();
		$obras0 = Array("0"=>"Seleccione");
	$obras = Obra::Where("proyecto_id","=",Session::get("proyecto")->id)->lists("nombre","id");
	 $obras = $obras0+$obras;
 return View::make('apu.editar')->with("partidas",$partidas)->with("obras",$obras);

}


public function editar2($id){




$data = Input::all();

$arreglo = Array();

//print_r($data["apu"]);
//echo count($data["apu"]);
//echo $data["apu"][0]["nombre"];
for($i=0;$i<count($data["apu"]);$i++)
{
	$apu = new Apu;

	$data["apu"][$i] = array_add($data["apu"][$i], 'cantidadpartida', $data["cantidadpartida"]);
		$data["apu"][$i] = array_add($data["apu"][$i], 'partida_id', $data["partida_id"]);
		$data["apu"][$i] = array_add($data["apu"][$i], 'obra_id', $data["obra_id"]);


	if($data["apu"][$i]["nombre"] != "")
		
	

	if($apu->isValid($data["apu"][$i]))
	{

		//echo "valido ";
		
		array_push($arreglo, "valido");
	}
	else
	{
		
		array_push($arreglo, "invalido");
		return Redirect::to("apu/editar/".$id)->withInput()->withErrors($apu->errors);
	}
	

}





if(in_array("invalido", $arreglo))  // si existe invalido es error
{
	
}
else // si no existe guarda en la bd
{
	$partida = Partida::find($id);
	$apus = Apu::Where("partida_id","=",$partida->id);
	$apus->delete();
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


//$apus->delete();

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


public function clonarApu()
{


	$partidas = Partida::Where('item',"=",'503-2')->Orderby('orden')->get();

$apus = Array();
	foreach ($partidas as $partida) {

		
		if(count($partida->apu) >0)
		{

				foreach ($partida->apu as $apu) {

					array_push($apus, $apu);
					
				}

			

		}
		else
		{
			 
				foreach ($apus as $apu2) {

					$apuclon = new Apu;
					$apuclon->fill(array("partida_id"=>$partida->id,"nombre"=>$apu2->nombre,"unidad"=>$apu2->unidad,"preciou"=>$apu2->preciou,"cantidad"=>$apu2->cantidad,"rend"=>$apu2->rend,"costo"=>$apu2->costo,"proyecto_id"=>$apu2->proyecto_id,"categoria"=>$apu2->categoria));
					$apuclon->save();
					
				}
		
			
		}
		# code...
	}

//print_r($apus);

}



}

?>