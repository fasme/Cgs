<?php
class GastogeneralController extends BaseController {

public function mostrar(){

	$gg = Gastogeneral::Where("proyecto_id","=",Session::get("proyecto")->id)->get();

	return View::make("gastosgenerales.lista", array("gg"=>$gg));

}

public function nuevo(){
//where('proyecto_id',"=",Session::get("proyecto")->id)->get()->lists("nombre","id");
	/*
	$proyectos = Proyecto::find()->lists("nombre","id");
	array_unshift($proyectos, ' --- Seleccione un Proyecto --- ');
	$selected = array();
*/


	$ggcategorias = Ggcategoria::Where("proyecto_id","=",Session::get("proyecto")->id)->lists("nombre","id");
	array_unshift($ggcategorias, ' --- Seleccione un Proyecto --- ');
	$selected2 = array();


	return View::make("gastosgenerales.crear",  compact('ggcategorias','selected2'));
	//return "ho";
}

public function nuevo2(){


	 $input = Input::get('gg');
	//return $input;
	//DB::table('gg')->insert($input);
   //Gastogeneral::create($input);
	

	for($i=0;$i<count($input);$i++)
{
	
	if($input[$i]["nombre"] != "")
	{
	//echo $input[$i]["nombre"];

		//array_push($input[$i], "ordencompra_id",$lastid);
		//dd($input[$i]);
	Gastogeneral::create(array("proyecto_id"=>Input::get("proyecto_id"),"ggcategoria_id"=>$input[$i]["ggcategoria_id"],"nombre"=>$input[$i]["nombre"],"unidad"=>$input[$i]["unidad"],"cantidad"=>$input[$i]["cantidad"],"precio"=>$input[$i]["precio"]));

	}
}


return Redirect::to('gastogeneral');
}



public function editar($id){   //get


	$gastogeneral = Gastogeneral::find($id);
	$ggcategorias = Ggcategoria::Where("proyecto_id","=",Session::get("proyecto")->id)->lists("nombre","id");
	array_unshift($ggcategorias, ' --- Seleccione un Proyecto --- ');
	$selected2 = array();


	return View::make("gastosgenerales.editar")->with('ggcategorias',$ggcategorias)->with("gastogeneral",$gastogeneral);
}


public function editar2($id){

$gastogeneral = Gastogeneral::find($id);

$data = Input::all();
$gastogeneral->fill($data);
$gastogeneral->save();
return Redirect::to("gastogeneral");
}


public function eliminar()
{
	$id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $gastogeneral = Gastogeneral::find($id);

        $gastogeneral->delete();
        //return $id;
}


}
