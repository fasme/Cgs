<?php
class Controlingreso extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'controlingreso';
    protected $fillable = array('fecha','descripcion', 'neto', 'impuesto','descuento','obra_id', 'proyecto_id','total','iva','observacion','documento');


  public function obra()
    {
        return $this->belongsTo('Obra');
    }



public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            'descripcion' => 'required',
            'neto' => 'required|integer',
            'obra_id' => 'exists:obra,id',
           
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