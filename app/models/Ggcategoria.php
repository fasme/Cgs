<?php
class Ggcategoria extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'ggcategoria';
   protected $fillable = array('nombre');


   public function gastogeneral()
    {
        return $this->hasMany('Gastogeneral');

    }

    public function controlgasto()
    {
    	return $this->hasMany('Controlgasto');
    }


    public function controlgastogg()
    {
        return $this->hasMany('Controlgastogg');
    }
  
}
?>