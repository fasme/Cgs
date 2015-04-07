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
              <a href={{ URL::to('controlingreso') }}>Control de ingreso</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver ingreos</li>
          </ul><!--.breadcrumb-->

          @stop
 
@section('contenido')
     
<div class="page-header position-relative">
            <h1>
              Crear Control de ingreso
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


  <div class="span12 widget-container-span">
                  <div class="widget-box">
                    <div class="widget-header">
                     

                      <div class="widget-toolbar no-border">
                        <ul class="nav nav-tabs" id="myTab">
                          <li id="gastoactivetab">
                            <a data-toggle="tab" href="#home">Ingreso</a>
                          </li>

                        
                          
                        </ul>
                      </div>
                    </div>

                    <div class="widget-body">
                      <div class="widget-main padding-6">
                        <div class="tab-content">
                          <div id="home" class="tab-pane in active">
                            <div class="span5">

<?php
    if ($controlingreso->exists):
        $form_data = array('url' => 'controlingreso/editar/'.$controlingreso->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'controlingreso/crear');
        $action    = 'Crear';        
    endif;



 
?>

        {{ Form::open($form_data) }}
        
       
          
            {{Form::hidden('proyecto_id',Session::get("proyecto")->id) }}

            {{Form::label('Obra', 'Obra')}}
            {{Form::select('obra_id', $obras,$controlingreso->obra_id, array('id' => 'obras'))}}
            
            {{Form::label('Fecha', 'Fecha')}}
            {{Form::text('fecha', date_format(date_create($controlingreso->fecha),'d/m/Y'), array("class"=>"input-mask-date"))}}
            <small class="text-success">dd/mm/aaaa</small>

            {{Form::label('Descripcion','Descripcion')}}
            {{Form::text('descripcion',$controlingreso->descripcion)}}

            {{Form::label('Observacion','Observacion')}}
            {{Form::text('observacion',$controlingreso->observacion)}}


            
            {{Form::label('Tipo de Documento','Tipo de Documento')}}
            {{Form::select('documento',array("0"=>"Seleccione documento","2"=>"Factura","3"=>"Otro"), $controlingreso->documento,array("id"=>"tipodocumento"))}}



            {{Form::label('Neto','Neto')}}
            {{Form::text('neto',$controlingreso->neto,array("id"=>"neto"))}}



            {{Form::label('IVA')}}
            {{Form::text('iva',$controlingreso->iva,array("id"=>"iva","readonly"=>"readonly"))}}

           

            {{Form::label('Total')}}
            {{Form::text('total',$controlingreso->total,array("id"=>"total", "readonly"=>"readonly"))}}


       
            

       

           



             
</div>
                          </div>


                 
                        </div>
 {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}

                               
            
                      </div>


                    </div>


  

   </div><!--/row-->


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



<script>
  $(document).ready(function(){
   
    $('#obras').change(function(){

       $('#partidas').empty();
       $('#partidas').append("<option value='" + "0" + "'>" + "seleccione una partida" + "</option>");
       $("#partidas").trigger("liszt:updated");

      $.get("{{ url('dropdown2')}}",
      { option: $(this).val() },
      function(data) {

        
        $('#partidas').empty();

        $('#partidas').append("<option value='" + "0" + "'>" + "seleccione una partida" + "</option>");

        $.each(data, function(key, element) {

          $('#partidas').append("<option value='" + key + "'>" + element + "</option>");
          $("#partidas").trigger("liszt:updated");

        });
        

      });
    });  // fin obras change


    $("#concepto").change(function(){
   

      if($(this).val() == "GG")
      {
     $("#categoriadiv").show();
     $("#partidadiv").hide();
      }
      else if($(this).val() == "CD")
      {
        $("#partidadiv").show();
        $("#categoriadiv").hide();
      }
    }); // fin conecpto change



      
   

$("#partidas").chosen(); 
$('.input-mask-date').mask('99/99/9999');


$("#partidadiv").hide();
$("#categoriadiv").hide();



// si es editar
    if($("#concepto").val() == "GG")
      {
    
     $("#categoriadiv").show();
     $("#partidadiv").hide();
      }
      else if($("#concepto").val() == "CD")
      {

        $("#partidadiv").show();
        $("#categoriadiv").hide();
      }










// SI ES EDITAR
var tipodocumento = $("#tipodocumento").val();

if( tipodocumento == 1 || tipodocumento == 3) // boleta y otros
{


  var neto = parseFloat($("#neto").val());
$("#impuestos").val(0);
$("#descuento").val(0);
$("#iva").val(0);
var total = neto;
total = Math.round(total);
$("#total").val(total);
$("#total").val(neto);


$("#impuestos").prop('readonly', true);
$("#descuento").prop('readonly', true);


$("#neto").keyup(function(){
var neto = parseFloat($("#neto").val());
var iva = 0;
$("#iva").val(iva);
$("#total").val(neto);

});



}


else if( tipodocumento== 2 || tipodocumento == 4) // boleta y otros
{


$("#impuestos").prop('readonly', false);
$("#descuento").prop('readonly', false);

var neto = parseFloat($("#neto").val());
var iva = Math.round(neto*0.19);
$("#iva").val(iva);
var impuestos = 0;
var descuento = 0;

var total = neto + iva;
total = Math.round(total);
$("#total").val(total);

$("#neto").keyup(function(){
var neto = parseFloat($("#neto").val());
var iva = Math.round(neto*0.19);
$("#iva").val(iva);
var impuestos = 0;
var descuento = 0;

var total = neto + iva;
total = Math.round(total);
$("#total").val(total);
});


$("#impuestos").keyup(function(){
var neto = parseFloat($("#neto").val());
var iva = Math.round(neto*0.19);
$("#iva").val(iva);
var impuestos = 0;
var descuento = 0;
var total = neto + iva;
total = Math.round(total);
$("#total").val(total);
});

$("#descuento").keyup(function(){
var neto = parseFloat($("#neto").val());
var iva = Math.round(neto*0.19);
$("#iva").val(iva);
var impuestos = 0;
var descuento = 0;
var total = neto + iva;
total = Math.round(total);
$("#total").val(total);
});



}

// FIN SI ES EDITAR


// CALCULAR IVA TOTAL DESCUENTO AL CAMBIAR SELECT
$("#tipodocumento").change(function(){

var tipodocumento = $("#tipodocumento").val();

if( tipodocumento == 1 || tipodocumento == 3) // boleta y otros
{


  var neto = parseFloat($("#neto").val());
$("#impuestos").val(0);
$("#descuento").val(0);
$("#iva").val(0);
var total = neto;
total = Math.round(total);
$("#total").val(total);
$("#total").val(neto);


$("#impuestos").prop('readonly', true);
$("#descuento").prop('readonly', true);


$("#neto").keyup(function(){
var neto = parseFloat($("#neto").val());
var iva = 0;
$("#iva").val(iva);
$("#total").val(neto);

});



}


else if( tipodocumento== 2 || tipodocumento == 4) // boleta y otros
{


$("#impuestos").prop('readonly', false);
$("#descuento").prop('readonly', false);

var neto = parseFloat($("#neto").val());
var iva = Math.round(neto*0.19);
$("#iva").val(iva);
var impuestos = parseFloat($("#impuestos").val());
var descuento = parseFloat($("#descuento").val());

var total = neto + iva;
total = Math.round(total);
$("#total").val(total);

$("#neto").keyup(function(){
var neto = parseFloat($("#neto").val());
var iva = Math.round(neto*0.19);
$("#iva").val(iva);
var impuestos = parseFloat($("#impuestos").val());
var descuento = parseFloat($("#descuento").val());

var total = neto + iva;
total = Math.round(total);
$("#total").val(total);
});


$("#impuestos").keyup(function(){
var neto = parseFloat($("#neto").val());
var iva = Math.round(neto*0.19);
$("#iva").val(iva);
var impuestos = parseFloat($("#impuestos").val());
var descuento = parseFloat($("#descuento").val());
var total = neto + iva;
total = Math.round(total);
$("#total").val(total);
});

$("#descuento").keyup(function(){
var neto = parseFloat($("#neto").val());
var iva = Math.round(neto*0.19);
$("#iva").val(iva);
var impuestos = parseFloat($("#impuestos").val());
var descuento = parseFloat($("#descuento").val());
var total = neto + iva;
total = Math.round(total);
$("#total").val(total);
});



}

  });



// FUNCION para mostrar el tab cheque
$("#gastoactivetab").addClass("active");
$("#tipopago").change(function(){

if($(this).val() == "2")
{

$("#chequeactivetab").addClass("active");
$("#profile").addClass("in active");
$("#home").removeClass("in active");
$("#gastoactivetab").removeClass("active");
}
});


//
$( "#controlingresoactive" ).addClass( "active" );
$( "#controlcostoactive" ).addClass( "active" );
    
  });   
</script>

@stop


