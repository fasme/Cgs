<?php
class Partida extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'partida';
   protected $fillable = array('nombre','item','unidad','cantidad','orden','obra_id','categoria_id','proyecto_id');


   public function partidaCategoria()
    {
        return $this->belongsTo('Partidacategoria');
    }

    public function obra()
    {
    	return $this->belongsTo('Obra');
    }


    public function controlgastocd()
    {
        return $this->hasMany('Controlgastocd');
    }
}
?>