<?php
class Crons extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'cron';
    protected $fillable = array('cron');



  public function partida()
    {
        return $this->belongsTo('Partida');
    }




}
?>