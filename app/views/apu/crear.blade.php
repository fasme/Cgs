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
              <a href={{ URL::to('apu') }}>APU</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Apu</li>
          </ul><!--.breadcrumb-->

          @stop
 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Crear Apu
              <small>
                <i class="icon-double-angle-right"></i>
                
              </small>
            </h1>
          </div><!--/.page-header-->



<div class="row-fluid">
  {{ Form::open(array('url' => 'gastogeneral/crear')) }}
  <div class="span3">

            {{Form::hidden('proyecto_id',Session::get("proyecto")->id) }}
       
            {{Form::label('Partida', 'Partida')}}
            {{Form::select('gg[0][partida_id]', $partidas, $selected,array('class' => 'partidas'))}}

            {{Form::label('Categoria', 'Categoria')}}
            {{Form::select('gg[0][categoria]', array("1"=>"I.- MAQUINARIAS. Equipos y Herramientas","2"=>"II.- MATERIALES POR UNIDAD DE OBRA.
", "3"=>"III.- MANO DE OBRA.") )}}
           
            {{Form::label('Nombre', 'Nombre')}}
            {{Form::text('gg[0][nombre]', '')}}
            {{Form::label('Unidad', 'Unidad')}}
            {{Form::text('gg[0][unidad]', '')}}

            {{Form::label('Precio U', 'Precio U')}}
            {{Form::text('gg[0][precio]', '')}}
         
            {{Form::label('Cantidad', 'Cantidad')}}
            {{Form::text('gg[0][cantidad]', '')}}

            



</div>



  <div class="span3">

        
        
       
            {{Form::label('Partida', 'Partida')}}
            {{Form::select('gg[0][partida_id]', $partidas, $selected,array('class' => 'partidas'))}}

            {{Form::label('Categoria', 'Categoria')}}
            {{Form::select('gg[0][categoria]', array("1"=>"I.- MAQUINARIAS. Equipos y Herramientas","2"=>"II.- MATERIALES POR UNIDAD DE OBRA.
", "3"=>"III.- MANO DE OBRA.") )}}
           
            {{Form::label('Nombre', 'Nombre')}}
            {{Form::text('gg[0][nombre]', '')}}
            {{Form::label('Unidad', 'Unidad')}}
            {{Form::text('gg[0][unidad]', '')}}

            {{Form::label('Precio U', 'Precio U')}}
            {{Form::text('gg[0][precio]', '')}}
         
            {{Form::label('Cantidad', 'Cantidad')}}
            {{Form::text('gg[0][cantidad]', '')}}

            



</div>



  <div class="span3">

        
        
       
            {{Form::label('Partida', 'Partida')}}
            {{Form::select('gg[0][partida_id]', $partidas, $selected,array('class' => 'partidas'))}}

            {{Form::label('Categoria', 'Categoria')}}
            {{Form::select('gg[0][categoria]', array("1"=>"I.- MAQUINARIAS. Equipos y Herramientas","2"=>"II.- MATERIALES POR UNIDAD DE OBRA.
", "3"=>"III.- MANO DE OBRA.") )}}
           
            {{Form::label('Nombre', 'Nombre')}}
            {{Form::text('gg[0][nombre]', '')}}
            {{Form::label('Unidad', 'Unidad')}}
            {{Form::text('gg[0][unidad]', '')}}

            {{Form::label('Precio U', 'Precio U')}}
            {{Form::text('gg[0][precio]', '')}}
         
            {{Form::label('Cantidad', 'Cantidad')}}
            {{Form::text('gg[0][cantidad]', '')}}

            



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
$( "#apuactive" ).addClass( "active" );






    
  });   
</script>

@stop


