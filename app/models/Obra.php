<?php
class Obra extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'obra';
   protected $fillable = array('nombre', 'proyecto_id');

   public function proyecto()
    {
        return $this->belongsTo('Proyecto');
    }

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

    public function partidacategoria()
    {
        return $this->hasMany("Partidacategoria");
    }

}
?>