<?php




class Usuarioproyecto extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'usuario_proyecto';
    protected $fillable = array('proyecto_id', 'usuario_id');


}
 
?>