<?php
class Ordencompra extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'ordencompra';
   protected $fillable = array('id','proveedor_id', 'codobra','fecha');


   public function ordencompradetalle()
    {
        return $this->hasMany('Ordencompradetalle');
    }



    public function proveedor()
    {
        return $this->belongsTo('Proveedor');
    }

    /*

    public function cheque()
    {
        return $this->hasMany('Cheque');
    }

    public function controlgasto()

    {
        return $this->hasMany('Controlgasto');
    }


*/

}
?>