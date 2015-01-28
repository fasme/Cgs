<?php
class Ordencompra extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'ordencompra';
   protected $fillable = array('id','proveedor_id', 'codobra','fecha','telcel','mercaderia','fechaentrega','pago');


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


    public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            'fecha' => 'required|date_format:d/m/Y',
            'proveedor_id' => 'exists:proveedor,id',
            'fechaentrega'=>'required'
            
        );
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

}
?>