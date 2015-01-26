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

        {{ Form::open(array('url' => 'partidas/crear')) }}
        
       
            {{Form::label('Obra', 'Obra')}}
            {{Form::select('obra_id', $obras, $selected,array('id' => 'obra'))}}

            {{Form::label('Categoria', 'Categoria')}}
            {{Form::select('categoria_id', $categorias, $selected,array('id' => 'obra'))}}

            {{Form::label('Item', 'Item')}}
            {{Form::text('item', '')}}

            {{Form::label('Nombre', 'Nombre')}}
            {{Form::text('nombre', '')}}

            {{Form::label('Unidad', 'Unidad')}}
            {{Form::text('unidad', '')}}
            

            {{Form::label('Cantidad', 'Cantidad')}}
            {{Form::text('cantidad', '')}}

            {{Form::label('Orden', 'Orden')}}
            {{Form::text('orden', '')}}

            {{Form::hidden('proyecto_id',Session::get("proyecto")->id) }}
            
            
            

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   

$('.input-mask-date').mask('99/99/9999');
$('.input-mask-date2').mask('99/99/9999');

$( "#partidasactive" ).addClass( "active" );

    
  });   
</script>

@stop


