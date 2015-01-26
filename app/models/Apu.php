<?php
class Apu extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'apu';
    protected $fillable = array('partida_id','nombre','unidad','preciou', 'cantidad','rend','costo');


/*
  public function ggcategoria()
    {
        return $this->belongsTo('Ggcategoria');
    }

*/



}
?>