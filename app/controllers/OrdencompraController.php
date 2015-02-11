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

$data = Input::all();
$ordencompra = new Ordencompra;


if($ordencompra->isValid($data))
{

	 list($dia,$mes,$ano) = explode("/",$data['fecha']);
     $data['fecha'] = "$ano-$mes-$dia";

     if($data['fechaentrega'] != "")
     {

     list($dia,$mes,$ano) = explode("/",$data['fechaentrega']);
     $data['fechaentrega'] = "$ano-$mes-$dia";
 	 }



	$ordencompra->fill($data);
	$ordencompra->save();
	$lastid =  $ordencompra->id;



	for($i=0;$i<count($data["oc"]);$i++)
{
	
	if($data["oc"][$i]["nombre"] != "")
	{

	Ordencompradetalle::create(array("nombre"=>$data["oc"][$i]["nombre"],"cantidad"=>$data["oc"][$i]["cantidad"],"medida"=>$data["oc"][$i]["medida"],"valoru"=>$data["oc"][$i]["valoru"],"ordencompra_id"=>$lastid));

	}
}


	return Redirect::to('ordencompra');
}
 else
        {
            return Redirect::to('ordencompra/nuevo')->withInput()->withErrors($ordencompra->errors);
        }

 




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

if($ordencompra->isValid($data))
{

 list($dia,$mes,$ano) = explode("/",$data['fecha']);
     $data['fecha'] = "$ano-$mes-$dia";

     if($data['fechaentrega'] != "")
     {

     list($dia,$mes,$ano) = explode("/",$data['fechaentrega']);
     $data['fechaentrega'] = "$ano-$mes-$dia";
 	 }



	$ordencompra->fill($data);
	$ordencompra->save();

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
 {
            return Redirect::to('ordencompra/nuevo')->withInput()->withErrors($ordencompra->errors);
        }




//$ordencompra = Ordencompra::create(array('proveedor_id'=>Input::get('proveedor_id'),'fecha'=>$fecha));
//$lastid =  $ordencompra->id;

  

}


public function eliminar(){

	$id = Input::get("id");
    $orden = Ordencompra::find($id);
    $orden->delete();
}


public function generarOrdenPDF($id){




		 $ordenes = Ordencompra::find($id);

	   $html =  View::make("ordencompra.pdf")->with("ordenes",$ordenes);

      return PDF::load($html, 'A4', 'portrait')->download("Orden de compra N ".$ordenes->id);


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

})->export('xls');


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