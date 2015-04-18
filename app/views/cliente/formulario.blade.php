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
              <a href={{ URL::to('cliente') }}>Cliente</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Proveedor</li>
          </ul><!--.breadcrumb-->

          @stop
 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Crear Cliente
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
  <div class="span4">

           <?php
  // si existe el usuario carga los datos
    if ($cliente->exists):
        $form_data = array('url' => 'cliente/editar/'.$cliente->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'cliente/crear');
        $action    = 'Crear';        
    endif;

?>


{{ Form::open($form_data) }}
       
          
            {{Form::label('Nombre', 'Nombre')}}
            {{Form::text('nombre', $cliente->nombre)}}
            {{Form::label('Rut', 'Rut')}}
            {{Form::text('rut', $cliente->rut)}}
         
            {{Form::label('Fono')}}
            {{Form::text('fono', $cliente->fono)}}

            {{Form::label('Email')}}
            {{Form::text('email', $cliente->email)}}

            {{Form::label('Direccion')}}
            {{Form::text('direccion', $cliente->direccion)}}

            {{Form::label('Ciudad')}}
            {{Form::text('ciudad', $cliente->ciudad)}}

            {{Form::label('Giro')}}
            {{Form::text('giro', $cliente->giro)}}

            {{Form::label('Nombre Contacto')}}
            {{Form::text('nombrecontacto', $cliente->nombrecontacto)}}

             {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}



    

  
</div>

   </div><!--/row-->



<script>
  $(document).ready(function(){
   

$('.input-mask-date').mask('99/99/9999');
$('.input-mask-date2').mask('99/99/9999');

$( "#ordencompraactive" ).addClass( "active" );
$( "#clienteactive" ).addClass( "active" );
    
  });   
</script>

@stop


