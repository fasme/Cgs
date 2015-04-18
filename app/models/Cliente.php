<?php
class Cliente extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'cliente';
   protected $fillable = array( 'nombre','rut','fono','email','direccion','ciudad','giro','nombrecontacto');



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