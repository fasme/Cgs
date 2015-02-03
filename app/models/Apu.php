<?php
class Apu extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'apu';
    protected $fillable = array('partida_id','nombre','unidad','preciou', 'cantidad','rend','costo','proyecto_id','categoria');



  public function partida()
    {
        return $this->belongsTo('Partida');
    }




}
?>