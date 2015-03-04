@extends('layouts.master')
 


@section('breadcrumb')
<ul class="breadcrumb">
            <li>
              <i class="fa fa-home home-fa fa"></i>
              <a href="#">Home</a>

              <span class="divider">
                <i class="fa fa-angle-right arrow-fa fa"></i>
              </span>
            </li>

            <li>
              <a href={{ URL::to('proyectos') }}>{{ Session::get('proyecto')->nombre}}</a>

              <span class="divider">
                <i class="fa fa-angle-right arrow-fa fa"></i>
              </span>
            </li>
            <li>Informe Contabilidad</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')



{{(isset($data))}}

<div class="page-header position-relative">
            <h1>
              Informe Contabilidad
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
<?php /*
    {{ Form::open(array('url' => 'controlgasto/informecontabilidad')) }}

    {{Form::label("Desde")}}
    {{Form::text("desde","",array("class"=>"input-mask-date"))}}
    <small class="text-success">dd/mm/yyyy</small>
    {{Form::label("Hasta")}}
    {{Form::text("hasta","",array("class"=>"input-mask-date"))}}
    <small class="text-success">dd/mm/yyyy</small>
    {{Form::submit('Enviar', array('class'=>'btn btn-small btn-success'))}}
  
    {{ Form::close() }}
     */ ?>


     {{ Form::open(array('url' => 'controlgasto/informecontabilidad', "target"=>"_blank")) }}

<?php $meses = array("1"=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); ?>
<?php $ano = date("Y");

$anos = array($ano=>$ano,$ano+1=>$ano+1,$ano+2=>$ano+2); ?>       
    {{Form::label("Mes")}}
    {{Form::select("periodomes",$meses)}}

    {{Form::label("Año")}}
    {{Form::select("periodoano",$anos)}}
    {{Form::submit('Enviar', array('class'=>'btn btn-small btn-success'))}}
  
    {{ Form::close() }}
  </div>
  </div>     
 


  <script type="text/javascript">
 $(document).ready(function() {



$( "#ordencompraactive" ).addClass( "active" );
$('.input-mask-date').mask('99/99/9999');



}); // fin ready
 </script>




        

        


@stop

