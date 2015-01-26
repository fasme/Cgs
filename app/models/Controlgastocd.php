<?php
class Controlgastocd extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'controlgastocd';
 protected $fillable = array('controlgasto_id','partida_id');

   public function controlgasto()
    {
        return $this->belongsTo('Controlgasto');
    }

	public function partida()
    {
    	return $this->belongsTo("Partida");
    }
}
?>