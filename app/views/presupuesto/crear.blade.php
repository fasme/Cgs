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
  {{ Form::open(array('url' => 'gastogeneral/crear')) }}
  <div class="span3">

        
        
       
            {{Form::label('Proyecto', 'Proyecto')}}
            {{Form::select('gg[0][proyecto_id]', $proyectos, $selected,array('class' => 'proyectos'))}}

   
           
            {{Form::label('Nombre', 'Nombre')}}
            {{ Form::checkbox('agree') }}

          
{{ Form::checkbox('agree') }}
<span class="lbl"> Puente 1</span>

{{ Form::checkbox('agree') }}
<span class="lbl"> Puente 2</span>







            



</div>



  <d




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


