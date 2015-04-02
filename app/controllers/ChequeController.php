<?php
class ChequeController extends BaseController {

public function mostrar(){ // vista

	 $cheques = Cheque::where("proyecto_id",'=',Session::get("proyecto")->id)->get();

	// echo $obra = Obra::find($cheques->obra);
	 $cheques->proveedor = 1;

	// $cheques->id;
	//$input = array_filter(Cheque::all(), 'strlen');
	return View::make("cheques.lista", array("cheques"=>$cheques));
	 //return View::make("cheques.lista")->with("cheques", $cheques,"ola",'iipo');

}

public function nuevo(){  //vista

	$obras = Obra::where('proyecto_id',"=",Session::get("proyecto")->id)->get()->lists("nombre","id");
	array_unshift($obras, ' --- Seleccione una Obra --- ');
	$selected = array();

	$partidas = Partida::all()->lists("nombre","id");
  array_unshift($partidas, ' --- Seleccione una Partida --- ');
	$selected2 = array();

	return View::make("cheques.crear", compact('obras', 'selected'), compact("partidas", "selected2","1"));
	//return "ho";
}


public function nuevo2(){  //post


	 $cheque = new Cheque;

	$data = Input::all();

	 if ($cheque->isValid($data))
        {
            // Si la data es valida se la asignamos al usuario
            $cheque->fill($data);
            // Guardamos el usuario
             $fechapago = $cheque->fechapago;
            list($dia,$mes,$ano) = explode("/",$fechapago);
			$fechapago = "$ano-$mes-$dia";


			$cheque->fechapago = $fechapago;
			
            $cheque->save();

            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::action('ChequeController@mostrarCheques');
            
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
return Redirect::route('cheques/nuevo')->withInput()->withErrors($cheque->errors);
        	//return "mal2";
        }
	//$cheques->save();



	//return Redirect::to("cheques");


}



public function editar($id)
{

	$obras = Obra::where('proyecto_id',"=",Session::get("proyecto")->id)->get()->lists("nombre","id");
	array_unshift($obras, ' --- Seleccione una Obra --- ');
	$selected = array();

	$partidas = Partida::all()->lists("nombre","id");
  array_unshift($partidas, ' --- Seleccione una Partida --- ');
	$selected2 = array();

	return View::make("cheques.crear", compact('obras', 'selected'), compact("partidas", "selected2","1"));


}




public function eliminar()
{
	$id = Input::get("id");
	$cheque = Cheque::find($id);
	$cheque->delete();


}


public function cron()
{
	$hoy = date("Y-m-d");

	$cheques = Cheque::whereRaw("DATEDIFF(fechapago,'$hoy') > 0")
	->whereRaw("DATEDIFF(fechapago,'$hoy') < 2")
	->get();


//return View::make("cheques.mail")->with("cheques",$cheques);
if(count($cheques) >0)
{
	Mail::send('cheques.mail', array('cheques' => $cheques), function($message)
{
    $message->to('fasme2h@gmail.com', 'Daniel')->cc('dagabol@gmail.com','Daniel')->subject('Tienes cheques por vencer!');
});
	
}

	



}





}