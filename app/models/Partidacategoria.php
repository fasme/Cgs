<?php
class Partidacategoria extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'partidacategoria';
   protected $fillable = array('nombre');


   public function partida()
    {
        return $this->hasMany('Partida');
    }
}
?>