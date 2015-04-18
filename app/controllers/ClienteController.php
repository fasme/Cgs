<?php
class ClienteController extends BaseController {

public function mostrar(){

	$cliente = Cliente::all();

	return View::make("cliente.lista")->with("clientes",$cliente);

}

public function nuevo(){

	$cliente = new Cliente;
	return View::make("cliente.formulario")->with("cliente",$cliente);
	//return "ho";
}



public function nuevo2(){

	 $cliente = new Cliente;
	 $data = Input::all();

	 if($cliente->isValid($data))
	 {
	 	$cliente->fill($data);
	 	$cliente->save();
	 	return Redirect::to("cliente");
	 }
	 else
	 {
	 	return Redirect::to("cliente/nuevo")->withInput()->withErrors($cliente->errors);
	 }
	


	
}




public function editar($id){

	 $cliente = Cliente::find($id);

	return View::make("cliente.formulario")->with("cliente",$cliente);
}

public function editar2($id){


 $cliente = Cliente::find($id);
  $data = Input::all();

   if($cliente->isValid($data))
	 {
	 	$cliente->fill($data);
	 	$cliente->save();
	 	return Redirect::to("cliente");
	 }

	  else
	 {
	 	return Redirect::to("cliente/nuevo")->withInput()->withErrors($cliente->errors);
	 }



  
}

public function eliminar()
{
		$id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $cliente = Cliente::find($id);

        $cliente->delete();
        //return $id;
}



}