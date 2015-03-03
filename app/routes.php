<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('cheques/cron', array('uses'=>'ChequeController@cron'));

Route::filter('old', function()
{
    if (Session::get('proyecto'))
   {
			
   	//return Redirect::to('');
		}
		else
		{
			//return Redirect::to('proyectos')->with("mensaje","Debes seleccionar un proyecto primero");
			$proyectos = Proyecto::all();

	return View::make("dashboard.lista")->with("proyectos",$proyectos)->with("mensaje","Primero debe seleccionar un proyecto");
		}
});






// LOGIN

Route::get('login', function(){
    return View::make('login.login');
});


Route::post('login', array('uses' => 'UsuariosController@postLogin'));

Route::get('logout', 'UsuariosController@logOut');




Route::group(array('before' => 'auth'), function()
{


	


	// PROYECTOS

	Route::get('proyectos', array('uses'=>'ProyectoController@mostrar'));
	Route::get('proyectos/nuevo', array('uses'=>'ProyectoController@nuevo'));
	Route::post('proyectos/crear', array('uses'=>'ProyectoController@nuevo2'));
	Route::get('proyectos/session/{id}', array('uses'=>'ProyectoController@sessionProyecto')); //crear session
	Route::get('proyectos/editar/{id}', array('uses'=>'ProyectoController@editar'));
	Route::post('proyectos/editar/{id}', array('uses'=>'ProyectoController@editar2'));
	Route::get('proyectos/eliminar', 'ProyectoController@eliminar');



		Route::group(array('before' => 'old'), function(){



			Route::get('/', array('uses'=>'DashboardController@mostrarDashboard'));


	Route::get('dashboard', array('uses'=>'DashboardController@mostrarDashboard'));

	// USUARIOS
	Route::get('usuarios', array('uses' => 'UsuariosController@mostrar'));

	Route::get('usuarios/nuevo', array('uses' => 'UsuariosController@nuevo'));
	 
	Route::post('usuarios/crear', array('uses' => 'UsuariosController@nuevo2'));
	// esta ruta es a la cual apunta el formulario donde se introduce la información del usuario
	// como podemos observar es para recibir peticiones POST
	 
	Route::get('usuarios/{id}', array('uses'=>'UsuariosController@verUsuario'));
	// esta ruta contiene un parámetro llamado {id}, que sirve para indicar el id del usuario que deseamos buscar
	// este parámetro es pasado al controlador, podemos colocar todos los parámetros que necesitemos
	// solo hay que tomar en cuenta que los parámetros van entre llaves {}
	// si el parámetro es opcional se colocar un signo de interrogación {parámetro?}

	Route::get('usuarios/editar/{id}', 'UsuariosController@editar');

	Route::post('usuarios/editar/{id}', 'UsuariosController@editar2');

	Route::get('usuarios/probando/oli', 'UsuariosController@pruebaSQL');




	// CHEQUES

	Route::get('cheques', array('as' => 'cheques','uses' => 'ChequeController@mostrar'));
	Route::get('cheques/nuevo', array('as' => 'cheques/nuevo','uses' => 'ChequeController@nuevo'));
	Route::post('cheques/crear', array('uses' => 'ChequeController@nuevo2'));
	Route::get('cheques/eliminar', array('uses' => 'ChequeController@eliminar'));
	Route::get('cheques/editar/{id}', array('uses' => 'ChequeController@editar'));
	Route::get('cheques/eliminar', array('uses'=>'ChequeController@eliminar'));
	//Route::get('cheques/cron', array('uses'=>'ChequeController@cron'));

	// funcion para select dinamico
	Route::get('dropdown', function(){
		$id = Input::get('option');
		$partidas = Obra::find($id)->partida;
		return $partidas->lists('nombre', 'id');
	});


	// funcion para proyecto -> obra

	Route::get('dropdown2', function(){
	    $id = Input::get('option');
	    $obras = Obra::find($id)->partida;
	    $arreglin = Array(""=>"");
	    foreach ($obras as $obra) {
	    	$arreglin = array_add($arreglin, $obra->id, $obra->nombre."/".$obra->partidacategoria->nombre);
	    }

	    //return $obras->lists('nombre', 'id');
	    return $arreglin;
	});


	// GG

	Route::get('gastogeneral', array('uses' => 'GastogeneralController@mostrar'));
	Route::get('gastogeneral/nuevo', array('uses' => 'GastogeneralController@nuevo'));

	Route::post('gastogeneral/crear', array('uses' => 'GastogeneralController@nuevo2'));

	Route::get('gastogeneral/editar/{id}', array('uses' => 'GastogeneralController@editar'));
	Route::post('gastogeneral/editar/{id}', array('uses' => 'GastogeneralController@editar2'));
	Route::get('gastogeneral/eliminar', array('uses' => 'GastogeneralController@eliminar'));

		    
			// OBRAS

			Route::get('obras', array('uses'=>'ObraController@mostrar'));
			Route::get('obras/nuevo', array('uses'=>'ObraController@nuevo'));
			Route::post('obras/crear', array('uses'=>'ObraController@nuevo2'));
			Route::get('obras/editar/{id}', array('uses'=>'ObraController@editar'));
			Route::post('obras/editar/{id}', array('uses'=>'ObraController@editar2'));
			Route::get('obras/eliminar', array('uses'=>'ObraController@eliminar'));

			// PARTIDAS

			Route::get('partidas', array('uses'=>'PartidaController@mostrar'));
			Route::get('partidas/nuevo', array('uses'=>'PartidaController@nuevo'));
			Route::post('partidas/crear', array('uses'=>'PartidaController@nuevo2'));
			Route::get('partidas/editar/{id}', array('uses' => 'PartidaController@editar'));
			Route::post('partidas/editar/{id}', array('uses' => 'PartidaController@editar2'));
			Route::get('partidas/eliminar', array('uses' =>'PartidaController@eliminar'));
			Route::get('partidas/buscarcategorias', function(){
	    $id = Input::get('option');
	    $obras = Obra::find($id)->partidacategoria;
	    
	    return $obras->lists('nombre', 'id');
	});


			// APU

			Route::get('apu', array('uses'=>'ApuController@mostrar'));
			Route::get('apu/nuevo', array('uses'=>'ApuController@nuevo'));
			Route::post('apu/crear', array('uses'=>'ApuController@nuevo2'));
			Route::get('apu/editar/{id}', array('uses'=>'ApuController@editar'));
			Route::post('apu/editar/{id}', array('uses'=>'ApuController@editar2'));
			Route::get('apu/eliminar', array('uses'=>'ApuController@eliminar'));
			Route::get('apu/buscarPartidas', array('uses'=>'ApuController@buscarPartidas'));
			Route::get('apu/clonarApu', array('uses'=>'ApuController@clonarApu'));

			// PRESUPUESTO

			Route::get('presupuesto', array('uses'=>'PresupuestoController@mostrar'));
			Route::get('presupuesto/nuevo', array('uses'=>'PresupuestoController@nuevo'));
			Route::post('presupuesto/crear', array('uses'=>'PresupuestoController@nuevo2'));
			Route::post('presupuesto/xls', array('uses'=>'PresupuestoController@xls'));


			// CONTROL GASTO

			Route::get('controlgasto', array('uses'=>'ControlgastoController@mostrar'));
			Route::get('controlgasto/nuevo', array('uses'=>'ControlgastoController@nuevo'));
			Route::post('controlgasto/crear', array('uses'=>'ControlgastoController@nuevo2'));
			Route::get('controlgasto/editar/{id}', array('uses' => 'ControlgastoController@editar'));
			Route::post('controlgasto/editar/{id}', array('uses' => 'ControlgastoController@editar2'));
			Route::get('controlgasto/eliminar', array('uses' => 'ControlgastoController@eliminar'));
			Route::get('controlgasto/buscarcategoriasgg', array('uses'=>'ControlgastoController@buscarcategoriasgg'));
			Route::get('controlgasto/informecontabilidad', array("uses"=>"ControlgastoController@informecontabilidad"));
			Route::post('controlgasto/informecontabilidad', array("uses"=>"ControlgastoController@informecontabilidad2"));


			// PROVEEDOR

			Route::get("proveedor",array("uses"=>"ProveedorController@mostrar"));
			Route::get('proveedor/nuevo', array('uses'=>'ProveedorController@nuevo'));
			Route::post('proveedor/crear', array('uses'=>'ProveedorController@nuevo2'));
			Route::get('proveedor/editar/{id}', array('uses' => 'ProveedorController@editar'));
			Route::post('proveedor/editar/{id}', array('uses' => 'ProveedorController@editar2'));
			Route::get('proveedor/eliminar', array('uses' => 'ProveedorController@eliminar'));
		


			// ORDEN DE COMPRA 
				
				
					Route::get('ordencompra', array('uses'=>'OrdencompraController@mostrar'));
					Route::get('ordencompra/nuevo', array('uses'=>'OrdencompraController@nuevo'));
					Route::post('ordencompra/crear', array('uses'=>'OrdencompraController@nuevo2'));
					Route::get('ordencompra/editar/{id}', array('uses' => 'OrdencompraController@editar'));
					Route::post('ordencompra/editar/{id}', array('uses' => 'OrdencompraController@editar2'));
					Route::get('ordencompra/eliminar', array('uses' => 'OrdencompraController@eliminar'));
					Route::get('ordencompra/xls/{id}', array('uses'=>'OrdencompraController@generarOrdenXLS'));
					Route::get('ordencompra/pdf/{id}', array('uses'=>'OrdencompraController@generarOrdenPDF'));
					Route::get('ordencompra/copiar/{id}', array("uses"=>"OrdencompraController@copiarOrden"));
					
					// INFORMES
					Route::get('informes/analisiscosto', array('uses'=>'InformeController@lista'));
					Route::get('informes/analisiscosto/detalle', array('uses'=>'InformeController@analisisCostoDetalle'));
					Route::get('informes/analisiscosto/resumen', array('uses'=>'InformeController@analisisCostoResumen'));
					Route::get('informes/analisiscosto/cdexcavacion/{obra}',array('uses'=>'InformeController@cdExcavacion'));
					Route::get('informes/analisiscosto/cdrellenos/{obra}',array('uses'=>'InformeController@cdRellenos'));
					Route::get('informes/analisiscosto/cdhormigon/{obra}',array('uses'=>'InformeController@cdHormigon'));
					Route::get('informes/analisiscosto/cdacero/{obra}',array('uses'=>'InformeController@cdAcero'));
					Route::get('informes/analisiscosto/cdmoldaje/{obra}',array('uses'=>'InformeController@cdMoldaje'));
					Route::get('informes/analisiscosto/cdenrocado/{obra}',array('uses'=>'InformeController@cdEnrocado'));
					Route::get('informes/analisiscosto/cdotros/{obra}',array('uses'=>'InformeController@cdOtros'));
					Route::get('informes/analisiscosto/{obra}',array('uses'=>'InformeController@analisisCostoObra'));
					
				

				});
		

});