<?php
class Ordencompradetalle extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'ordencompradetalle';
   protected $fillable = array('id','nombre', 'valoru', 'cantidad','ordencompra_id', 'medida');


   public function ordencompra()
    {
        return $this->belongsTo('Ordencompra');
    }


/*
    public function partida()
    {
        return $this->hasMany('Partida');
    }

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