<?php
class Gastogeneral extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'gg';
    protected $fillable = array('proyecto_id','ggcategoria_id','nombre','unidad','cantidad', 'precio');



  public function ggcategoria()
    {
        return $this->belongsTo('Ggcategoria');
    }

    public function proyecto(){

    	return $this->belongsTo('Proyecto');
    }




}
?>