<?php
class Proveedor extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'proveedor';
   protected $fillable = array('proveedor_id', 'nombre','rut','fono','email');


   public function ordencompra()
    {
        return $this->hasMany('Ordencompra');
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