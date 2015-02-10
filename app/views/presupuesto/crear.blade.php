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
              <a href={{ URL::to('apu') }}>Presupuesto</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Presupuesto</li>
          </ul><!--.breadcrumb-->

          @stop
 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Crear Presupuesto
              <small>
                <i class="icon-double-angle-right"></i>
                
              </small>
            </h1>
          </div><!--/.page-header-->



<div class="row-fluid">
  <div class="span3">
  {{ Form::open(array('url' => 'presupuesto/crear')) }}

  {{Form::label("Proyecto :")}}
  {{Form::text("proyecto",Session::get("proyecto")->nombre, array("readonly"=>"readonly"))}}
  {{Form::hidden("proyecto_id",Session::get("proyecto")->id)}}
  {{Form::submit("Generar presupuesto")}}
  


</div>


            {{Form::close()}}





   </div><!--/row-->



<script>
  $(document).ready(function(){
   
    $('#obra').change(function(){

      $.get("{{ url('dropdown')}}",
      { option: $(this).val() },
      function(data) {

        
        $('#partidas').empty();

        $('#partidas').append("<option value='" + "0" + "'>" + "seleccione una partida" + "</option>");

        $.each(data, function(key, element) {

          $('#partidas').append("<option value='" + key + "'>" + element + "</option>");
          $("#partidas").trigger("liszt:updated");

        });
        

      });
    });

$(".partidas").chosen(); 
$('.input-mask-date').mask('99/99/9999');
$( "#presupuestoactive" ).addClass( "active" );





    
  });   
</script>

@stop


