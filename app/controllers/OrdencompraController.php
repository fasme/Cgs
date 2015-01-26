<?php
class OrdencompraController extends BaseController {


public function mostrar(){

//$ordenes = Ordencompra::all();
//$ordenes = DB::select('select * from ordencompra');



/*
$ordenes = DB::table('ordencompra')
->leftJoin('ordencompradetalle','ordencompra.id','=','ordencompradetalle.ordencompra_id')
->select(DB::raw('*,sum(valoru*cantidad) as valoru'))->get();

*/

/*$ordenes = Ordencompra::leftJoin('ordencompradetalle', function($join) {
      $join->on('ordencompra.id', '=', 'ordencompradetalle.ordencompra_id');
    })
//->join('ordencompradetalle','ordencompra.id','=','ordencompradetalle.ordencompra_id')
->select(DB::raw('*,sum(valoru*cantidad) as valoru'))
->where("ordencompra.id", "=", "ordencompradetalle.ordencompra_id")
->get();

*/

$ordenes = Ordencompra::Join("ordencompradetalle","ordencompradetalle.ordencompra_id","=",'ordencompra.id')
->groupBy('ordencompradetalle.ordencompra_id')
->select(DB::raw('*,sum(valoru*cantidad) as valorneto'))
->get();


//return count($ordenes);
//return $ordenes;
return View::make("ordencompra.lista")->with("ordenes", $ordenes);
}


public function nuevo()
{
	$proveedores = Proveedor::all()->lists("nombre","id");
	array_unshift($proveedores, ' --- Seleccione un Proveedor --- ');
	$selected = array();

	$ordencompra = new Ordencompra;

	return View::make("ordencompra.crear")->with("proveedores",$proveedores)->with("ordencompra",$ordencompra);
	//return "ho";

}


public function nuevo2()
{


      $fecha = Input::get('fecha');
	list($dia,$mes,$ano) = explode("/",$fecha);
	 $fecha = "$ano-$mes-$dia";

$ordencompra = Ordencompra::create(array('proveedor_id'=>Input::get('proveedor_id'),'fecha'=>$fecha));
$lastid =  $ordencompra->id;

  $input = Input::get('oc');


for($i=0;$i<count($input);$i++)
{
	
	if($input[$i]["nombre"] != "")
	{
	//echo $input[$i]["nombre"];

		//array_push($input[$i], "ordencompra_id",$lastid);
		//dd($input[$i]);
	Ordencompradetalle::create(array("nombre"=>$input[$i]["nombre"],"cantidad"=>$input[$i]["cantidad"],"medida"=>$input[$i]["medida"],"valoru"=>$input[$i]["valoru"],"ordencompra_id"=>$lastid));

	}
}


return Redirect::to('ordencompra');
 




}


public function editar($id)
{



$proveedores = Proveedor::all()->lists("nombre","id");
	array_unshift($proveedores, ' --- Seleccione un Proveedor --- ');
	$selected = array();

$ordencompra = Ordencompra::find($id);

	return View::make("ordencompra.editar")->with("proveedores",$proveedores)->with("ordencompra",$ordencompra);

}


public function editar2($id)
{

 $ordencompra = Ordencompra::find($id);

 $data = Input::all();



 $fecha = Input::get('fecha');
	list($dia,$mes,$ano) = explode("/",$fecha);
	 $fecha = "$ano-$mes-$dia";
	 $data["fecha"] = $fecha;

 $ordencompra->fill($data);
 $ordencompra->save();

//$ordencompra = Ordencompra::create(array('proveedor_id'=>Input::get('proveedor_id'),'fecha'=>$fecha));
//$lastid =  $ordencompra->id;

   $input = Input::get('oc');

 $ordencompradetalle = Ordencompradetalle::Where("ordencompra_id","=",$ordencompra->id);

	 $ordencompradetalle->delete();


for($i=0;$i<count($input);$i++)
{

	
	if($input[$i]["nombre"] != "")
	{
	

	
	Ordencompradetalle::create(array("nombre"=>$input[$i]["nombre"],"cantidad"=>$input[$i]["cantidad"],"medida"=>$input[$i]["medida"],"valoru"=>$input[$i]["valoru"],"ordencompra_id"=>$ordencompra->id));

	}
}


return Redirect::to('ordencompra');

}


public function eliminar(){

	$id = Input::get("id");
    $orden = Ordencompra::find($id);
    $orden->delete();
}


public function generarOrdenPDF($id){




		 $ordenes = Ordencompra::find($id);

	   $html =  View::make("ordencompra.pdf")->with("ordenes",$ordenes);

      return PDF::load($html, 'A4', 'portrait')->show();


}


public function generarOrdenXLS($id){
/*
$ordenes = Ordencompra::find($id);
	return $html =  View::make("ordencompra.xls")->with("ordenes",$ordenes);
*/

Excel::create('New file', function($excel) use($id) {

    $excel->sheet('New sheet', function($sheet) use($id) {

    	$ordenes = Ordencompra::find($id);
        $sheet->loadView('ordencompra.xls')->with("ordenes",$ordenes);
$sheet->setWidth('B', 50);
$sheet->setWidth('C', 50);
        $sheet->cell('C1', function($cell) {
//
});

    });

})->export('xlsx');;



}


public function copiarOrden($id){

	$proveedores = Proveedor::all()->lists("nombre","id");
	array_unshift($proveedores, ' --- Seleccione un Proveedor --- ');
	$selected = array();

$ordencompra = Ordencompra::find($id);

	return View::make("ordencompra.copiar")->with("proveedores",$proveedores)->with("ordencompra",$ordencompra);



}







}

?>