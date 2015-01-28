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
            <li>Ver Cheques</li>
          </ul><!--.breadcrumb-->

          @stop
 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Crear Cheque
              <small>
                <i class="icon-double-angle-right"></i>
                
              </small>
            </h1>
          </div><!--/.page-header-->



<div class="row-fluid">
  <div class="span4">

        {{ Form::open(array('url' => 'cheques/crear')) }}
        
             {{Form::hidden('proyecto_id',Session::get("proyecto")->id) }}

            {{Form::label('Obra', 'Obra')}}
            {{Form::select('obra_id', $obras, '',array('id' => 'obra'))}}
            {{Form::label('Partida', 'Partida')}}
            {{Form::select('partida_id', $partidas, $selected2,array('id' => 'partidas'))}}
            {{Form::label('Proveedor', 'Proveedor')}}
            {{Form::text('proveedor', '')}}
      
         
            {{Form::label('Monto', 'Monto')}}
        
            {{Form::text('monto', '')}}

            
</div>
<div class="span4">


            {{Form::label('Numero', 'Numero')}}
            {{Form::text('numero', '')}}
      
            {{Form::label('Fecha Pago', 'Fecha Pago')}}


            {{Form::text('fechapago', '',array('id' => 'form-field-mask-1', 'class'=>'input-mask-date'))}} 

            <small class="text-success">99/99/9999</small>
            {{Form::label('Observaciones', 'Observaciones')}}
            {{Form::text('observaciones', '')}}
            {{Form::label('Revision', 'Revision')}}
            {{Form::select('revision', array('1'=>'Revisado','2'=>'Revisar'))}}

          


            {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}

          
</div>


   </div><!--/row-->

<div class="row-fluid">

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



<script>
  $(document).ready(function(){
   
    $('#obra').change(function(){
      
       $('#partidas').empty();
       $('#partidas').append("<option value='" + "0" + "'>" + "seleccione una partida" + "</option>");
       $("#partidas").trigger("liszt:updated");


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
$( "#chequeactive" ).addClass( "active" );


    
  });   
</script>

@stop


