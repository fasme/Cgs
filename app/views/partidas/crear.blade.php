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
              <a href={{ URL::to('cheques') }}>Partida</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Partidas</li>
          </ul><!--.breadcrumb-->

          @stop
 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Crear Partida
              <small>
                <i class="icon-double-angle-right"></i>
                
              </small>
            </h1>
          </div><!--/.page-header-->


<div class="row-fluid">
  <div class="span4">

     <?php
    if ($partida->exists):
        $form_data = array('url' => 'partidas/editar/'.$partida->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'partidas/crear');
        $action    = 'Crear';        
    endif;


?>

        {{ Form::open($form_data) }}
        
       
            {{Form::label('Obra', 'Obra')}}
            {{Form::select('obra_id', $obras, $partida->obra_id,array('id' => 'obra'))}}

            {{Form::label('Categoria', 'Categoria')}}
            {{Form::select('categoria_id', $categorias, $partida->categoria_id,array('id' => 'obra'))}}

            {{Form::label('Item', 'Item')}}
            {{Form::text('item', $partida->item)}}

            {{Form::label('Nombre', 'Nombre')}}
            {{Form::text('nombre', $partida->nombre)}}

            {{Form::label('Unidad', 'Unidad')}}
            {{Form::text('unidad', $partida->unidad)}}
            

            {{Form::label('Cantidad', 'Cantidad')}}
            {{Form::text('cantidad', $partida->cantidad)}}

            {{Form::label('Orden', 'Orden')}}
            {{Form::text('orden', $partida->orden)}}

            {{Form::hidden('proyecto_id',Session::get("proyecto")->id) }}
            
            
            

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}
</div>

   </div><!--/row-->
<div class="row-fluid">

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

  
  </div>


<script>
  $(document).ready(function(){
   

$('.input-mask-date').mask('99/99/9999');
$('.input-mask-date2').mask('99/99/9999');

$( "#partidasactive" ).addClass( "active" );
$( "#proyectoactive" ).addClass( "active" );

    
  });   
</script>

@stop


