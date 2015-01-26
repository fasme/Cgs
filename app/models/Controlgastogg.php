<?php
class Controlgastogg extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'controlgastogg';
   protected $fillable = array('controlgasto_id','ggcategoria_id');


   public function controlgasto()
    {
        return $this->belongsTo('Controlgasto');
    }


    public function ggcategoria()
    {
    	return $this->belongsTo("Ggcategoria");
    }


}
?>