<?php
class Partidacategoria extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'partidacategoria';
   protected $fillable = array('nombre','obra_id','proyecto_id');


   public function partida()
    {
        return $this->hasMany('Partida','categoria_id');
    }

    public function obra()
    {
    	return $this->hasMany('Obra');
    }
}
?>