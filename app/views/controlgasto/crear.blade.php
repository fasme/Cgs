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
              <a href={{ URL::to('cheques') }}>Control de gasto</a>

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



<div class="row-fluid">


  <div class="span12 widget-container-span">
                  <div class="widget-box">
                    <div class="widget-header">
                     

                      <div class="widget-toolbar no-border">
                        <ul class="nav nav-tabs" id="myTab">
                          <li class="active">
                            <a data-toggle="tab" href="#home">Gasto</a>
                          </li>

                          <li>
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

        {{ Form::open(array('url' => 'controlgasto/crear')) }}
        
       
          
            {{Form::hidden('proyecto_id',Session::get("proyecto")->id) }}

            {{Form::label('Obra', 'Obra')}}
            {{Form::select('obra_id', $obras,'', array('id' => 'obras'))}}
            

            {{Form::label('Concepto','Concepto')}}
            {{Form::select('concepto',array("0"=>"Seleccione concepto","GG"=>"GG","CD"=>"CD"),'',array("id"=>"concepto"))}}
            <small class="text-success">GG / CD</small>

            <div id="partidadiv">
            {{Form::label('Partida','Partida')}}
             {{Form::select('partida_id', $partidas,'',array('id' => 'partidas'))}}
            <small class="text-success">Ingresar solo si es CD</small>
          </div>



<div id="categoriadiv">
             {{Form::label('Categoria', 'Categoria')}}
             {{Form::select('ggcategoria_id', $ggs,array('id' => 'obras'))}}
             <small class="text-success">Ingresar solo si es GG</small>
           </div>

            {{Form::label('Fecha', 'Fecha')}}
            {{Form::text('fecha', '', array("class"=>"input-mask-date"))}}
            <small class="text-success">dd/mm/aaaa</small>

            {{Form::label('Descripcion','Descripcion')}}
            {{Form::text('desc','')}}

            {{Form::label('Proveedor','Proveedor')}}
            {{Form::text('proveedor','')}}
            
            {{Form::label('Documento','Documento')}}
            {{Form::text('documento','')}}

            {{Form::label('Neto','Neto')}}
            {{Form::text('neto','')}}


            {{Form::label('Tipo de pago')}}
        
            {{Form::select('tipopago',array("1"=>"Efectivo","2"=>"Cheque"))}}
            

       

           



             
</div>
                          </div>

                          <div id="profile" class="tab-pane">


                            {{Form::label('N Cheque','N Cheque')}}
            {{Form::text('ncheque','')}}

           
            {{Form::label('N Factura', 'N Factura')}}
            {{Form::text('factura', '')}}
         
          
         
      
            {{Form::label('Fecha Pago', 'Fecha Pago')}}


            {{Form::text('fechapago', '',array('id' => 'form-field-mask-1', 'class'=>'input-mask-date'))}} 
            <small class="text-success">99/99/9999</small>


            {{Form::label('Observaciones', 'Observaciones')}}
            {{Form::text('observaciones', '')}}

              {{Form::label('Revision', 'Revision')}}
            {{Form::select('revision', array('1'=>'Revisado','2'=>'Revisar'))}}



                          </div>

                 
                        </div>
 {{Form::submit('Guardar', array('class'=>'btn btn-small btn-success'))}}
        {{ Form::close() }}

                               
            
                      </div>


                    </div>


  

   </div><!--/row-->



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
    });


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
    });

$("#partidas").chosen(); 
$('.input-mask-date').mask('99/99/9999');
$( "#controlgastoactive" ).addClass( "active" );

$("#partidadiv").hide();
$("#categoriadiv").hide();

    
  });   
</script>

@stop


