<?php
class Proveedor extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'proveedor';
   protected $fillable = array('proveedor_id', 'nombre','rut','fono','email','direccion','ciudad');


   public function ordencompra()
    {
        return $this->hasMany('Ordencompra');
    }


    public function isValid($data)
    {

        $rules = array(
            'nombre' => 'required',
            'rut' => 'required',
            'email' => 'email'
             );

        $validator = Validator::make($data,$rules);

        if($validator->passes())
        {
            return true;
        }

        $this->errors = $validator->errors();
        
        return false;

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