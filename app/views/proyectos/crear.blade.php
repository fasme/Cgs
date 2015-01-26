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
              <a href={{ URL::to('cheques') }}>Cheques</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Proyectos</li>
          </ul><!--.breadcrumb-->

          @stop
 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Crear Proyecto
              <small>
                <i class="icon-double-angle-right"></i>
                
              </small>
            </h1>
          </div><!--/.page-header-->



<div class="row-fluid">
  <div class="span4">

        {{ Form::open(array('url' => 'proyectos/crear')) }}
        
       
          
            {{Form::label('Nombre', 'Nombre')}}
            {{Form::text('nombre', '')}}
            {{Form::label('Plazo', 'Plazo')}}
            {{Form::text('plazo', '')}}
         
            {{Form::label('Fecha Inicio', 'Fecha Inicio')}}
        
            {{Form::text('fechainicio', '',array('id' => 'form-field-mask-1', 'class'=>'input-mask-date'))}}
               <small class="text-success">dd/mm/aaaa</small>
            {{Form::label('Fecha Termino', 'Fecha Termino')}}
        
            {{Form::text('fechatermino', '',array('id' => 'form-field-mask-2', 'class'=>'input-mask-date2'))}}
             <small class="text-success">dd/mm/aaaa</small>


             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   

$('.input-mask-date').mask('99/99/9999');
$('.input-mask-date2').mask('99/99/9999');

$( "#proyectoactive" ).addClass( "active" );

    
  });   
</script>

@stop


