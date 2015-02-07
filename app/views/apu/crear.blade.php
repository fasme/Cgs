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
 {{ Form::open(array('url' => 'apu/crear', 'class'=>'form-inline')) }}



<div class="row-fluid">

   @if ($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Ha ocurrido un error:</strong>
      <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif

  
  </div>


<div class="row-fluid">

 {{Form::label('Obra', 'Obra')}}
            {{Form::select('obra_id', $obras, '' ,array('id' => 'obras'))}}

  {{Form::select("partida_id",$partidas,"",array("class"=>"partidas", "id"=>"partida_id"))}}
  {{Form::text("cantidadpartida","",array("class"=>"span2", "readonly"=>"readonly","id"=>"cantidadpartida"))}}
</div>

<div class="row-fluid">

 <div class="span12 widget-container-span">
<div class="widget-box">
<div class="widget-header">
                     

                      <div class="widget-toolbar no-border">
                        <ul class="nav nav-tabs" id="myTab">
                          <li class="active">
                            <a data-toggle="tab" href="#maquina">Maquinaria</a>
                          </li>

                          <li>
                            <a data-toggle="tab" href="#material">Materiales</a>
                          </li>

                          <li>
                            <a data-toggle="tab" href="#manoobra">Mano de obra</a>
                          </li>

                          
                        </ul>
                      </div> <!--div toolbar -->
                    </div> <!--div header -->


 

<div class="widget-body">
  <div class="widget-main padding-6">
    <div class="tab-content">
      <div id="maquina" class="tab-pane in active">

        <div class="row-fluid">

           <div id="contenedor">
    <table id="tabla">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Unidad</th>
          <th>Preciu Unitario</th>
          <th>Cantidad</th>
          <th>Rendimiento</th>
          <th>Costo Unitario</th>
        </tr>
      </thead>
      <tbody>


        @for ($i = 0; $i < 5; $i++)
        <tr>
        <td>{{Form::text("apu[$i][nombre]",'',array('id' => "nombremaquinaria$i"))}} </td>
        <td>{{Form::text("apu[$i][unidad]",'',array('class'=>"span10"))}}</td>
        <td>{{Form::text("apu[$i][preciou]",'0',array('class'=>"span10",'id' => "precioumaquinaria$i"))}}</td>
        <td>{{Form::text("apu[$i][cantidad]",'1',array('class'=>"span10",'id' => "cantidadmaquinaria$i"))}}</td>
        <td>{{Form::text("apu[$i][rendimiento]",'',array('class'=>"span10",'id' => "rendimientomaquinaria$i"))}}</td>
        <td>{{Form::text("apu[$i][costo]",'',array('class'=>"span10",'id' => "costomaquinaria$i"))}}</td>
        <td>{{Form::hidden("apu[$i][categoria]",'1')}}</td>
        </tr>
        @endfor
        
      </tbody>
      <tfoot>
        <tr>
          <td></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
        </tr>
      </tfoot>
    </table>
   
  </div>


       </div>

       <div id="linea">
     </div>
       

           
      </div>

      <div id="material" class="tab-pane">
        <div class="row-fluid">

           <div id="contenedor">
    <table id="tabla2">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Unidad</th>
          <th>Preciu Unitario</th>
          <th>Cantidad</th>
          <th>Rendimiento</th>
          <th>Costo Unitario</th>
        </tr>
      </thead>
      <tbody>
        @for ($i = 5; $i < 10; $i++)
        <tr>
        <td>{{Form::text("apu[$i][nombre]",'',array('id' => "nombrematerial$i"))}} </td>
        <td>{{Form::text("apu[$i][unidad]",'',array('class'=>"span10"))}}</td>
        <td>{{Form::text("apu[$i][preciou]",'0',array('class'=>"span10",'id' => "precioumaterial$i"))}}</td>
        <td>{{Form::text("apu[$i][cantidad]",'1',array('class'=>"span10",'id' => "cantidadmaterial$i"))}}</td>
        <td>{{Form::text("apu[$i][rendimiento]",'',array('class'=>"span10",'id' => "rendimientomaterial$i"))}}</td>
        <td>{{Form::text("apu[$i][costo]",'',array('class'=>"span10",'id' => "costomaterial$i"))}}</td>
        <td>{{Form::hidden("apu[$i][categoria]",'2')}}</td>
        </tr>
        @endfor
      </tbody>
      <tfoot>
        <tr>
          <td></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
        </tr>
      </tfoot>
    </table>
    
  </div>



       </div>

      </div>

      <div id="manoobra" class="tab-pane">
        <div class="row-fluid">

           <div id="contenedor">
    <table id="tabla3">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Unidad</th>
          <th>Preciu Unitario</th>
          <th>Cantidad</th>
          <th>Rendimiento</th>
          <th>Costo Unitario</th>
        </tr>
      </thead>
      <tbody>
        @for ($i = 10; $i < 15; $i++)
        <tr>
        <td>{{Form::text("apu[$i][nombre]",'',array('id' => "nombremanoobra$i"))}} </td>
        <td>{{Form::text("apu[$i][unidad]",'',array('class'=>"span10"))}}</td>
        <td>{{Form::text("apu[$i][preciou]",'0',array('class'=>"span10",'id' => "precioumanoobra$i"))}}</td>
        <td>{{Form::text("apu[$i][cantidad]",'1',array('class'=>"span10",'id' => "cantidadmanoobra$i"))}}</td>
        <td>{{Form::text("apu[$i][rendimiento]",'',array('class'=>"span10",'id' => "rendimientomanoobra$i"))}}</td>
        <td>{{Form::text("apu[$i][costo]",'',array('class'=>"span10",'id' => "costomanoobra$i"))}}</td>
        <td>{{Form::hidden("apu[$i][categoria]",'3')}}</td>
        </tr>
        @endfor
      </tbody>
      <tfoot>
        <tr>
          <td></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
        </tr>
      </tfoot>
    </table>
    
  </div>



       </div>
      </div>
    </div>
  </div>
</div>
          </div>  <!--div box -->

        </div>  <!--div span12 container -->



</div> <!--div row -->

{{Form::submit("Guardar")}}


 </div>



<script>


  $(document).ready(function(){


    $('#obras').change(function(){

       $('#partida_id').empty();
       $('#partida_id').append("<option value='" + "0" + "'>" + "seleccione una partida" + "</option>");
       $("#partida_id").trigger("liszt:updated");

      $.get("{{ url('dropdown2')}}",
      { option: $(this).val() },
      function(data) {

        
        $('#partida_id').empty();

        $('#partida_id').append("<option value='" + "0" + "'>" + "seleccione una partida" + "</option>");

        $.each(data, function(key, element) {

          $('#partida_id').append("<option value='" + key + "'>" + element + "</option>");
          $("#partida_id").trigger("liszt:updated");

        });
        

      });
    });
   
    $('#partida_id').change(function(){
     
      $.get("{{ url('apu/buscarPartidas')}}",
      { option: $(this).val() },
      function(data) {
    
        $("#cantidadpartida").val(data);
    
        

      });
    });

$(".partidas").chosen(); 
$('.input-mask-date').mask('99/99/9999');
$( "#apuactive" ).addClass( "active" );
$( "#proyectoactive" ).addClass( "active" );


$('input').change(function(){
    var cantidadpartida = $('#cantidadpartida').val();

    // MAQUINARIA

    if ($('#nombremaquinaria0').val() != '')
    {
    var rendimientomaquinaria0 = 1/cantidadpartida;
    var precioumaquinaria0 = $('#precioumaquinaria0').val();
    var cantidadmaquinaria0 = $('#cantidadmaquinaria0').val();
   var totalmaquinaria0 = Math.round(rendimientomaquinaria0 * precioumaquinaria0 * cantidadmaquinaria0) ;
    $("#rendimientomaquinaria0").val(rendimientomaquinaria0);
    $("#costomaquinaria0").val(totalmaquinaria0);
  }

    if ($('#nombremaquinaria1').val() != '')
    {
      var rendimientomaquinaria1 = 1/cantidadpartida;
    var precioumaquinaria1 = $('#precioumaquinaria1').val();
    var cantidadmaquinaria1 = $('#cantidadmaquinaria1').val();
   var totalmaquinaria1 = Math.round(rendimientomaquinaria1 * precioumaquinaria1 * cantidadmaquinaria1) ;
    $("#rendimientomaquinaria1").val(rendimientomaquinaria1);
    $("#costomaquinaria1").val(totalmaquinaria1);
    }


    if ($('#nombremaquinaria2').val() != '')
    {
      var rendimientomaquinaria2 = 1/cantidadpartida;
    var precioumaquinaria2 = $('#precioumaquinaria2').val();
    var cantidadmaquinaria2 = $('#cantidadmaquinaria2').val();
   var totalmaquinaria2 = Math.round(rendimientomaquinaria2 * precioumaquinaria2 * cantidadmaquinaria2) ;
    $("#rendimientomaquinaria2").val(rendimientomaquinaria2);
    $("#costomaquinaria2").val(totalmaquinaria2);
    }
    

    if ($('#nombremaquinaria3').val() != '')
    {
      var rendimientomaquinaria3 = 1/cantidadpartida;
    var precioumaquinaria3 = $('#precioumaquinaria3').val();
    var cantidadmaquinaria3 = $('#cantidadmaquinaria3').val();
   var totalmaquinaria3 = Math.round(rendimientomaquinaria3 * precioumaquinaria3 * cantidadmaquinaria3) ;
    $("#rendimientomaquinaria3").val(rendimientomaquinaria3);
    $("#costomaquinaria3").val(totalmaquinaria3);
    }


    if ($('#nombremaquinaria4').val() != '')
    {
      var rendimientomaquinaria4 = 1/cantidadpartida;
    var precioumaquinaria4 = $('#precioumaquinaria4').val();
    var cantidadmaquinaria4 = $('#cantidadmaquinaria4').val();
   var totalmaquinaria4 = Math.round(rendimientomaquinaria4 * precioumaquinaria4 * cantidadmaquinaria4) ;
    $("#rendimientomaquinaria4").val(rendimientomaquinaria4);
    $("#costomaquinaria4").val(totalmaquinaria4);
    }







    // MATERIAL
    if ($('#nombrematerial5').val() != '')
    {
    var rendimientomaterial5 = 1/cantidadpartida;
    var precioumaterial5 = $('#precioumaterial5').val();
    var cantidadmaterial5 = $('#cantidadmaterial5').val();
   var totalmaterial5 = Math.round(rendimientomaterial5 * precioumaterial5 * cantidadmaterial5) ;
    $("#rendimientomaterial5").val(rendimientomaterial5);
    $("#costomaterial5").val(totalmaterial5);
    }

    if ($('#nombrematerial6').val() != '')
    {
      var rendimientomaterial6 = 1/cantidadpartida;
    var precioumaterial6 = $('#precioumaterial6').val();
    var cantidadmaterial6 = $('#cantidadmaterial6').val();
   var totalmaterial6 = Math.round(rendimientomaterial6 * precioumaterial6 * cantidadmaterial6) ;
    $("#rendimientomaterial6").val(rendimientomaterial6);
    $("#costomaterial6").val(totalmaterial6);
    }


    if ($('#nombrematerial7').val() != '')
    {
      var rendimientomaterial7 = 1/cantidadpartida;
    var precioumaterial7 = $('#precioumaterial7').val();
    var cantidadmaterial7 = $('#cantidadmaterial7').val();
   var totalmaterial7 = Math.round(rendimientomaterial7 * precioumaterial7 * cantidadmaterial7) ;
    $("#rendimientomaterial7").val(rendimientomaterial7);
    $("#costomaterial7").val(totalmaterial7);
    }
    

    if ($('#nombrematerial8').val() != '')
    {
      var rendimientomaterial8 = 1/cantidadpartida;
    var precioumaterial8 = $('#precioumaterial8').val();
    var cantidadmaterial8 = $('#cantidadmaterial8').val();
   var totalmaterial8 = Math.round(rendimientomaterial8 * precioumaterial8 * cantidadmaterial8) ;
    $("#rendimientomaterial8").val(rendimientomaterial8);
    $("#costomaterial8").val(totalmaterial8);
    }


    if ($('#nombrematerial9').val() != '')
    {
      var rendimientomaterial9 = 1/cantidadpartida;
    var precioumaterial9 = $('#precioumaterial9').val();
    var cantidadmaterial9 = $('#cantidadmaterial9').val();
   var totalmaterial9 = Math.round(rendimientomaterial9 * precioumaterial9 * cantidadmaterial9) ;
    $("#rendimientomaterial9").val(rendimientomaterial9);
    $("#costomaterial9").val(totalmaterial9);
    }



// MANO DE OBRA


if ($('#nombremanoobra10').val() != '')
    {
    var rendimientomanoobra10 = 1/cantidadpartida;
    var precioumanoobra10 = $('#precioumanoobra10').val();
    var cantidadmanoobra10 = $('#cantidadmanoobra10').val();
   var totalmanoobra10 = Math.round(rendimientomanoobra10 * precioumanoobra10 * cantidadmanoobra10) ;
    $("#rendimientomanoobra10").val(rendimientomanoobra10);
    $("#costomanoobra10").val(totalmanoobra10);
    }

    if ($('#nombremanoobra11').val() != '')
    {
      var rendimientomanoobra11 = 1/cantidadpartida;
    var precioumanoobra11 = $('#precioumanoobra11').val();
    var cantidadmanoobra11 = $('#cantidadmanoobra11').val();
   var totalmanoobra11 = Math.round(rendimientomanoobra11 * precioumanoobra11 * cantidadmanoobra11) ;
    $("#rendimientomanoobra11").val(rendimientomanoobra11);
    $("#costomanoobra11").val(totalmanoobra11);
    }


    if ($('#nombremanoobra12').val() != '')
    {
      var rendimientomanoobra12 = 1/cantidadpartida;
    var precioumanoobra12 = $('#precioumanoobra12').val();
    var cantidadmanoobra12 = $('#cantidadmanoobra12').val();
   var totalmanoobra12 = Math.round(rendimientomanoobra12 * precioumanoobra12 * cantidadmanoobra12) ;
    $("#rendimientomanoobra12").val(rendimientomanoobra12);
    $("#costomanoobra12").val(totalmanoobra12);
    }
    

    if ($('#nombremanoobra13').val() != '')
    {
      var rendimientomanoobra13 = 1/cantidadpartida;
    var precioumanoobra13 = $('#precioumanoobra13').val();
    var cantidadmanoobra13 = $('#cantidadmanoobra13').val();
   var totalmanoobra13 = Math.round(rendimientomanoobra13 * precioumanoobra13 * cantidadmanoobra13) ;
    $("#rendimientomanoobra13").val(rendimientomanoobra13);
    $("#costomanoobra13").val(totalmanoobra13);
    }


    if ($('#nombremanoobra14').val() != '')
    {
      var rendimientomanoobra14 = 1/cantidadpartida;
    var precioumanoobra14 = $('#precioumanoobra14').val();
    var cantidadmanoobra14 = $('#cantidadmanoobra14').val();
   var totalmanoobra14 = Math.round(rendimientomanoobra14 * precioumanoobra14 * cantidadmanoobra14) ;
    $("#rendimientomanoobra14").val(rendimientomanoobra14);
    $("#costomanoobra14").val(totalmanoobra14);
    }



    
    });











    
  });   
</script>

@stop


