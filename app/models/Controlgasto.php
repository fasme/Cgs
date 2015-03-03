<?php
class Controlgasto extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'controlgasto';
    protected $fillable = array('fecha','desc','proveedor','documento', 'numdocumento', 'neto', 'impuesto','descuento','obra_id','concepto', 'proyecto_id', 'tipopago');



  public function obra()
    {
        return $this->belongsTo('Obra');
    }


    public function ggcategoria()
    {
    	return $this->belongsTo('Ggcategoria');
    }

    public function controlgastogg()
    {
        return $this->hasOne('Controlgastogg');
    }

    public function controlgastocd()
    {
        return $this->hasOne('Controlgastocd');
    }

    public function cheque()
    {
        return $this->hasOne('Cheque');
    }


public $errors;
    
    public function isValid($data) // funcion que valida los datos
    {
        $rules = array(
            'desc' => 'required',
            'proveedor'     => 'required',
            'numdocumento' => 'required|unique:controlgasto,numdocumento',
            'neto' => 'required|integer',
            'obra_id' => 'exists:obra,id',
            'impuesto' => 'integer',
            'descuento' => 'integer'
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