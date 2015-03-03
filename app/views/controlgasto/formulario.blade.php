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
              <a href={{ URL::to('controlgasto') }}>Control de gasto</a>

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
              Crear Control de gasto
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
                            <a data-toggle="tab" href="#home">Gasto</a>
                          </li>

                          <li id="chequeactivetab">
                            <a data-toggle="tab" href="#profile">Cheque</a>
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
    if ($controlgasto->exists):
        $form_data = array('url' => 'controlgasto/editar/'.$controlgasto->id);
        $action    = 'Editar';
    else:
        $form_data = array('url' => 'controlgasto/crear');
        $action    = 'Crear';        
    endif;

    $tiposelect = 1;
    if($controlgasto->concepto == "CD")
    $tiposelect = $controlgasto->controlgastocd->partida->id;
  elseif($controlgasto->concepto == "GG")
    $tiposelect = $controlgasto->controlgastogg->ggcategoria->id;

?>

        {{ Form::open($form_data) }}
        
       
          
            {{Form::hidden('proyecto_id',Session::get("proyecto")->id) }}

            {{Form::label('Obra', 'Obra')}}
            {{Form::select('obra_id', $obras,$controlgasto->obra_id, array('id' => 'obras'))}}
            

            {{Form::label('Concepto','Concepto')}}
            {{Form::select('concepto',array("0"=>"Seleccione concepto","GG"=>"GG","CD"=>"CD"), $controlgasto->concepto,array("id"=>"concepto"))}}
            <small class="text-success">GG / CD</small>

            <div id="partidadiv">
            {{Form::label('Partida','Partida')}}
             {{Form::select('partida_id', $partidas,$tiposelect,array('id' => 'partidas'))}}
            <small class="text-success">Ingresar solo si es CD</small>
          </div>



<div id="categoriadiv">
             {{Form::label('Categoria', 'Categoria')}}
             {{Form::select('ggcategoria_id', $ggs,$tiposelect,array('id' => 'categorias'))}}
             <small class="text-success">Ingresar solo si es GG</small>

             <div id="cargaGastosGenerales" class='alert alert-block alert-success'></div>
           </div>

            {{Form::label('Fecha', 'Fecha')}}
            {{Form::text('fecha', date_format(date_create($controlgasto->fecha),'d/m/Y'), array("class"=>"input-mask-date"))}}
            <small class="text-success">dd/mm/aaaa</small>

            {{Form::label('Descripcion','Descripcion')}}
            {{Form::text('desc',$controlgasto->desc)}}

            {{Form::label('Proveedor','Proveedor')}}
            {{Form::text('proveedor',$controlgasto->proveedor)}}


            
            {{Form::label('Tipo de Documento','Tipo de Documento')}}
            {{Form::select('documento',array("1"=>"Boleta","2"=>"Factura","4"=>"Nota de credito","3"=>"Otro"), $controlgasto->documento,array("id"=>"tipodocumento"))}}

            <?php $meses = array("1"=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); ?>
            <?php $ano = date("Y");

$anos = array($ano=>$ano,$ano+1=>$ano+1,$ano+2=>$ano+2); ?>   
            {{Form::label('Periodo')}}
            {{Form::select('periodomes',$meses, $controlgasto->periodomes,array("id"=>"periodo"))}}
            {{Form::select('periodoano',$anos, $controlgasto->periodoano,array("id"=>"periodo"))}}

            {{Form::label('Numero de Documento','Numero de Documento')}}
            {{Form::text('numdocumento',$controlgasto->numdocumento)}}

            {{Form::label('Neto','Neto')}}
            {{Form::text('neto',$controlgasto->neto,array("id"=>"neto"))}}



            {{Form::label('IVA')}}
            {{Form::text('iva','',array("id"=>"iva","disabled"=>"disabled"))}}

            {{Form::label('Otros Impuestos')}}
            {{Form::text('impuesto',$controlgasto->impuesto ? $controlgasto->impuesto:0,array("id"=>"impuestos"))}}

            {{Form::label('Descuento')}}
            {{Form::text('descuento',$controlgasto->descuento ? $controlgasto->descuento:0 ,array("id"=>"descuento"))}}

            {{Form::label('Total')}}
            {{Form::text('total','0',array("id"=>"total", "disabled"=>"disabled"))}}


            {{Form::label('Tipo de pago')}}
        
            {{Form::select('tipopago',array("1"=>"Efectivo","2"=>"Cheque","3"=>"Tarjeta","4"=>"Transferencia"),$controlgasto->tipopago,array("id"=>"tipopago"))}}
            

       

           



             
</div>
                          </div>

                          <div id="profile" class="tab-pane">
                            <?php 
                            if($controlgasto->cheque){
                            
                              $numero = $controlgasto->cheque->numero;
                             
                              $fechapago = $controlgasto->cheque->fechapago;
                              $observaciones = $controlgasto->cheque->observaciones;
                              $revision = $controlgasto->cheque->revision;

                            }
                            else
                            {
                              $numero = '';
                            
                              $fechapago ='';
                              $observaciones = '';
                              $revision ='';
                            }
                           
                         
                            ?> 


                        
            {{Form::label('N Cheque','N Cheque')}}
            {{Form::text('numero',$numero)}}

    
          
         
      
            {{Form::label('Fecha Pago', 'Fecha Pago')}}


            {{Form::text('fechapago', date_format(date_create($fechapago),'d/m/Y'),array('id' => 'form-field-mask-1', 'class'=>'input-mask-date'))}} 
            <small class="text-success">99/99/9999</small>


            {{Form::label('Observaciones', 'Observaciones')}}
            {{Form::text('observaciones', $observaciones)}}

              {{Form::label('Revision', 'Revision')}}
            {{Form::select('revision', array('1'=>'Revisado','2'=>'Revisar'),$revision)}}



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


// FUNCION para cargar en el espacio verde los items
$("#categorias").change(function(){
$("#cargaGastosGenerales").empty();
$.get("{{ url('controlgasto/buscarcategoriasgg')}}",
      { option: $(this).val() },
      function (data){ 
  


        $.each(data, function(key, element) {

       // alert(element);
          $("#cargaGastosGenerales").append(element + "<br>");
        });

      }
      );
      
});



// CALCULAR IVA TOTAL DESCUENTO

var neto = parseFloat($("#neto").val());
var iva = Math.round(neto*0.19);
$("#iva").val(iva);
var impuestos = parseFloat($("#impuestos").val());
var descuento = parseFloat($("#descuento").val());

var total = neto + iva + impuestos - descuento;
total = Math.round(total);
$("#total").val(total);

$("#neto").keyup(function(){
var neto = parseFloat($("#neto").val());
var iva = Math.round(neto*0.19);
$("#iva").val(iva);
var impuestos = parseFloat($("#impuestos").val());
var descuento = parseFloat($("#descuento").val());

var total = neto + iva + impuestos - descuento;
total = Math.round(total);
$("#total").val(total);
});


$("#impuestos").keyup(function(){
var neto = parseFloat($("#neto").val());
var iva = Math.round(neto*0.19);
$("#iva").val(iva);
var impuestos = parseFloat($("#impuestos").val());
var descuento = parseFloat($("#descuento").val());
var total = neto + iva + impuestos - descuento;
total = Math.round(total);
$("#total").val(total);
});

$("#descuento").keyup(function(){
var neto = parseFloat($("#neto").val());
var iva = Math.round(neto*0.19);
$("#iva").val(iva);
var impuestos = parseFloat($("#impuestos").val());
var descuento = parseFloat($("#descuento").val());
var total = neto + iva + impuestos - descuento;
total = Math.round(total);
$("#total").val(total);
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
$( "#controlgastoactive" ).addClass( "active" );

    
  });   
</script>

@stop


