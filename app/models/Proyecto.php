<?php
class Proyecto extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'proyecto';
   protected $fillable = array('nombre', 'plazo', 'fechainicio','fechatermino','img');

   public function obra()
    {
        return $this->hasMany('Obra');
    }

    public function gastogeneral()
    {
    	return $this->hasMany('Gastogeneral');
    }
}
?>