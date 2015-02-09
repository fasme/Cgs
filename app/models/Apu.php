<?php
class Apu extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'apu';
    protected $fillable = array('partida_id','nombre','unidad','preciou', 'cantidad','rend','costo','proyecto_id','categoria');



  public function partida()
    {
        return $this->belongsTo('Partida');
    }

public $errors;
    
    public function isValid($data)
    {
        $rules = array(
                       
          
            'unidad' => 'required',
            'preciou' => 'required|numeric',
            'cantidad' => 'required|numeric',
            'rendimiento' => 'required|numeric',
            'costo'=>'required|numeric',
            'cantidadpartida' => 'required',
            'partida_id' =>'exists:partida,id',
            'obra_id' => 'exists:obra,id'
            

            
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