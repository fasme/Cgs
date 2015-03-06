<?php
class BodegaController extends BaseController {

public function mostrar(){

	$bodega = Bodega::all();

	return View::make("bodega.lista")->with("bodegas",$bodega);

}

public function nuevo(){

	$bodega = new Bodega;
	return View::make("bodega.formulario")->with("bodega",$bodega);
	//return "ho";
}



public function nuevo2(){

	 $bodega = new Bodega;
	 $data = Input::all();

	 if($bodega->isValid($data))
	 {
	 	list($dia,$mes,$ano) = explode("/",$data["ultimarevision"]);
	 	$data["ultimarevision"] = $ano."-".$mes."-".$dia;
	 	$bodega->fill($data);
	 	$bodega->save();
	 	return Redirect::to("bodega");
	 }
	 else
	 {
	 	return Redirect::to("bodega/nuevo")->withInput()->withErrors($bodega->errors);
	 }
	


	
}




public function editar($id){

	 $bodega = Bodega::find($id);

	return View::make("bodega.formulario")->with("bodega",$bodega);
}

public function editar2($id){


 $bodega = Bodega::find($id);
  $data = Input::all();

   if($bodega->isValid($data))
	 {
	 	list($dia,$mes,$ano) = explode("/",$data["ultimarevision"]);
	 	$data["ultimarevision"] = $ano."-".$mes."-".$dia;
	 	$bodega->fill($data);
	 	$bodega->save();
	 	return Redirect::to("bodega");
	 }

	  else
	 {
	 	return Redirect::to("bodega/nuevo")->withInput()->withErrors($bodega->errors);
	 }



  
}

public function eliminar()
{
		$id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $bodega = Bodega::find($id);

        $bodega->delete();
        //return $id;
}



}