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
              <a href={{ URL::to('proyectos') }}>{{ Session::get('proyecto')->nombre}}</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Obras</li>
          </ul><!--.breadcrumb-->

          @stop
 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Crear Obra
              <small>
                <i class="icon-double-angle-right"></i>
                
              </small>
            </h1>
          </div><!--/.page-header-->



<div class="row-fluid">
  <div class="span4">


           <?php
  // si existe el usuario carga los datos
    if ($obra->exists):
        $form_data = array('url' => 'obras/editar/'.$obra->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'obras/crear');
        $action    = 'Crear';        
    endif;

?>
        
       {{ Form::open($form_data) }}
       
        

       
            {{Form::hidden('proyecto_id', Session::get('proyecto')->id)}}
            

            {{Form::label('Nombre', 'Nombre')}}
            {{Form::text('nombre', $obra->nombre)}}
            

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}


</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   

$('.input-mask-date').mask('99/99/9999');
$('.input-mask-date2').mask('99/99/9999');


$( "#obraactive" ).addClass( "active" );
$( "#proyectoactive" ).addClass( "active" );
    
  });   
</script>

@stop


