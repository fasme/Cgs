<?php
class Bodega extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'bodega';
   protected $fillable = array('codigo', 'nombre','ubicacion','estado','ultimarevision','observacion');


   public function ordencompra()
    {
        return $this->hasMany('Ordencompra');
    }


    public function isValid($data)
    {

        $rules = array(
            'codigo' => 'required',
            'nombre' => 'required',
            
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