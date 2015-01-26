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
              <a href={{ URL::to('gastogeneral') }}>Gasto general</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Gastos</li>
          </ul><!--.breadcrumb-->

          @stop
 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Crear Gasto
              <small>
                <i class="icon-double-angle-right"></i>
                
              </small>
            </h1>
          </div><!--/.page-header-->



<div class="row-fluid">
  {{ Form::open(array('url' => 'gastogeneral/editar/'.$gastogeneral->id)) }}
  <div class="span3">

        
        
       
     
            {{Form::hidden('proyecto_id',Session::get("proyecto")->id) }}

            {{Form::label('Categoria', 'Categoria')}}
            {{Form::select('ggcategoria_id', $ggcategorias, $gastogeneral->ggcategoria_id,array('id' => 'ggcategorias'))}}
           
            {{Form::label('Nombre', 'Nombre')}}
            {{Form::text('nombre', $gastogeneral->nombre)}}
            {{Form::label('Unidad', 'Unidad')}}
            {{Form::text('unidad', $gastogeneral->unidad)}}
         
            {{Form::label('Cantidad', 'Cantidad')}}
            {{Form::text('cantidad', $gastogeneral->cantidad)}}

            {{Form::label('Precio', 'Precio')}}
            {{Form::text('precio', $gastogeneral->precio)}}


{{ Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
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

$("#partidas").chosen(); 
$('.input-mask-date').mask('99/99/9999');


$( "#gastogeneralactive" ).addClass( "active" );



    
  });   
</script>

@stop


