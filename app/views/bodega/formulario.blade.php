@extends('layouts.master')
 
@section('breadcrumb')
<ul class="breadcrumb">
            <li>
              <i class="icon-home home-icon"></i>
              <a href="#">Home</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>

            <li>
              <a href={{ URL::to('controlgasto') }}>Bodega</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Bodega</li>
          </ul><!--.breadcrumb-->

          @stop
 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Crear Bodega
              <small>
                <i class="icon-double-angle-right"></i>
                
              </small>
            </h1>
          </div><!--/.page-header-->


@if ($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Por favor corrige los siguentes errores:</strong>
      <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif


<div class="row-fluid">


                            <div class="span5">

<?php
    if ($bodega->exists):
        $form_data = array('url' => 'bodega/editar/'.$bodega->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'bodega/crear');
        $action    = 'Crear';        
    endif;



?>

        {{ Form::open($form_data) }}
        
       
          
            {{Form::hidden('proyecto_id',Session::get("proyecto")->id) }}

           




            {{Form::label('Codigo', 'Codigo')}}
            {{Form::text('codigo',$bodega->codigo)}}

            {{Form::label('Nombre','Nombre')}}
            {{Form::text('nombre',$bodega->nombre)}}

            {{Form::label('ubicacion','Ubicacion')}}
            {{Form::text('ubicacion',$bodega->ubicacion)}}

            {{Form::label('Estado')}}
            {{Form::select('estado',array("1"=>"1","2"=>"2","3"=>"3","4"=>"4"),$bodega->estado)}}

            {{Form::label('Ultima revision')}}
            {{Form::text('ultimarevision', date_format(date_create($bodega->fecha),'d/m/Y'), array("class"=>"input-mask-date"))}}
            <small class="text-success">dd/mm/aaaa</small>

            {{Form::label('Observacion','Observacion')}}
            {{Form::text('observacion',$bodega->observacion)}}

            

       

           



             
</div>
                          </div>


                 
 {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}

                               
            

  




          @if ($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Por favor corrige los siguentes errores:</strong>
      <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif



<script>
  $(document).ready(function(){
   
  

      
   

$('.input-mask-date').mask('99/99/9999');



//
$( "#bodegaactive" ).addClass( "active" );

    
  });   
</script>

@stop


