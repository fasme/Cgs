<?php
class AdminController extends BaseController {


public function mostrar(){


        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('admin.lista');

}




}

?>