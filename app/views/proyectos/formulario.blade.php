@extends('layouts.admin')
 
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

           <?php
  // si existe el usuario carga los datos
    if ($proyectos->exists):
        $form_data = array('url' => 'proyectos/editar/'.$proyectos->id, 'files' => true);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'proyectos/crear', 'files' => true);
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       
          
            {{Form::label('Nombre', 'Nombre')}}
            {{Form::text('nombre', $proyectos->nombre)}}
            {{Form::label('Plazo', 'Plazo')}}
            {{Form::text('plazo', $proyectos->plazo)}}
         
            {{Form::label('Fecha Inicio', 'Fecha Inicio')}}
        
            {{Form::text('fechainicio', date_format(date_create($proyectos->fechainicio),'d/m/Y') ,array('id' => 'form-field-mask-1', 'class'=>'input-mask-date'))}}
               <small class="text-success">dd/mm/aaaa</small>
            {{Form::label('Fecha Termino', 'Fecha Termino')}}
        
            {{Form::text('fechatermino', date_format(date_create($proyectos->fechatermino),'d/m/Y'),array('id' => 'form-field-mask-2', 'class'=>'input-mask-date2'))}}
             <small class="text-success">dd/mm/aaaa</small>

             {{ Form::label('photo', 'Foto') }}
                
                <!--así se crea un campo file en laravel-->
                {{ Form::file('img') }}


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


