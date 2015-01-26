<?php
class Cheque extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'cheque';
    protected $fillable = array('obra_id','factura','pendiente','numero','fechapago','observaciones','revision','proyecto_id','controlgasto_id');
   


   public function obra()
    {
    	return $this->belongsTo('Obra');
    }


    public function controlgasto()
    {
        return $this->belongsTo('Controlgasto');
    }


    public $errors;
    
    public function isValid($data)
    {
        $rules = array(
                       
            'factura'     => 'required|integer',
            'numero' => 'required|integer'
            
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