<?php
class Partida extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'partida';
   protected $fillable = array('nombre','item','unidad','cantidad','orden','obra_id','categoria_id','proyecto_id');


   public function partidacategoria()
    {
        return $this->belongsTo('Partidacategoria','categoria_id');
    }

    public function obra()
    {
    	return $this->belongsTo('Obra');
    }


    public function controlgastocd()
    {
        return $this->hasMany('Controlgastocd');
    }


    public function apu()
    {
        return $this->hasMany("Apu");
    }




    public function isValid($data, $id)
    {
      
        $rules = array(
                       
            'item'     => 'required',
            'nombre' => 'required',
            'unidad' => 'required',
            'cantidad' => 'required|numeric',
            'orden' => 'required|integer',
            'obra_id' => 'required|exists:obra,id',
            'categoria_id' => 'required|exists:partidacategoria,id'
           // 'orden' => 'unique:partida,orden,'.$id
            
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