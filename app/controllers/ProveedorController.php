<?php
class ProveedorController extends BaseController {

public function mostrar(){

	$proveedor = Proveedor::all();

	return View::make("proveedor.lista")->with("proveedores",$proveedor);

}

public function nuevo(){

	$proveedor = new Proveedor;
	return View::make("proveedor.formulario")->with("proveedor",$proveedor);
	//return "ho";
}



public function nuevo2(){

	 $proveedor = new Proveedor;
	 $data = Input::all();

	 if($proveedor->isValid($data))
	 {
	 	$proveedor->fill($data);
	 	$proveedor->save();
	 	return Redirect::to("proveedor");
	 }
	 else
	 {
	 	return Redirect::to("proveedor/nuevo")->withInput()->withErrors($proveedor->errors);
	 }
	


	
}




public function editar($id){

	 $proveedor = Proveedor::find($id);

	return View::make("proveedor.formulario")->with("proveedor",$proveedor);
}

public function editar2($id){


 $proveedor = Proveedor::find($id);
  $data = Input::all();

   if($proveedor->isValid($data))
	 {
	 	$proveedor->fill($data);
	 	$proveedor->save();
	 	return Redirect::to("proveedor");
	 }

	  else
	 {
	 	return Redirect::to("proveedor/nuevo")->withInput()->withErrors($proveedor->errors);
	 }



  
}

public function eliminar()
{
		$id = Input::get('id'); //acedemos a la variable id traida por AJAX ($.get)
        $proveedor = Proveedor::find($id);

        $proveedor->delete();
        //return $id;
}



}