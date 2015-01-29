<?php
class UsuariosController extends BaseController {
 
    /**
     * Mustra la lista con todos los usuarios
     */
    public function mostrar()
    {
        $usuarios = Usuario::all();
        
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        
        return View::make('usuarios.lista', array('usuarios' => $usuarios));
        
        // El método make de la clase View indica cual vista vamos a mostrar al usuario
        //y también pasa como parámetro los datos que queramos pasar a la vista.
        // En este caso le estamos pasando un array con todos los usuarios
    }


     public function nuevo()
    {
        return View::make('usuarios.crear');
    }
 
 
    /**
     * Crear el usuario nuevo
     */
    public function crear()
    {
        //Usuario::create(Input::all());

        $usuario = new Usuario;

        $usuario->password = Hash::make(Input::get('pasword'));
        

        $usuario->save();
        //password = Hash::make("dagabol");

    // el método create nos permite crear un nuevo usuario en la base de datos, este método es proporcionado por Laravel
    // create recibe como parámetro un arreglo con datos de un modelo y los inserta automáticamente en la base de datos
    // en este caso el arreglo es la información que viene desde un formulario y la obtenemos con el metido Input::all()
        
        return Redirect::to('usuarios');
    // el método redirect nos devuelve a la ruta de mostrar la lista de los usuarios
 
    }
 
     /**
     * Ver usuario con id
     */
    public function verUsuario($id)
    {
    // en este método podemos observar como se recibe un parámetro llamado id
    // este es el id del usuario que se desea buscar y se debe declarar en la ruta como un parámetro
    
        $usuario = Usuario::find($id);
        // para buscar al usuario utilizamos el metido find que nos proporciona Laravel
        // este método devuelve un objete con toda la información que contiene un usuario
    
    return View::make('usuarios.ver', array('usuario' => $usuario));
    }

    public function editar($id) //get
    {
        //echo $id;
            
 
           $user = Usuario::find($id);

   
        return View::make('usuarios.editar', array('usuario' => $user));
 
                
 
      
    }


    public function editar2($id) //post
    {
        
         $user = Usuario::find($id);
        $user->nombre = Input::get("nombre");
        $user->apellido = Input::get("apellido");
        $user->password = Hash::make(Input::get("password"));
        $user->save();

        return Redirect::to('usuarios');
      
    }




    public function pruebaSQL()
    {
        $usuarios = DB::table('usuarios')->where('nombre', '=', 'Daniel')->get();
        return $usuarios;
        //return "oli";
    }




    public function postLogin(){

    if (Auth::attempt(['usuario' => Input::get('usuario'), 'password' => Input::get('password') ])){
       
        return Redirect::to('/');
    }else{
        
        return Redirect::to('login')->with('mensaje_login', 'Ingreso invalido')->withInput();
    }
    
    }


    public function logOut(){

        Auth::logout();
        Session::forget('proyecto');
        return Redirect::to('login')
                    ->with('mensaje_login', 'Tu sesión ha sido cerrada.');
    }



 






}



?>