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


  {{ Form::open(array('url' => 'gastogeneral/crear', 'class'=>'form-inline')) }}

<div class="widget-body">
  <div class="widget-main padding-6">
    <div class="tab-content">
      <div id="maquina" class="tab-pane in active">

        <div class="row-fluid">

           <div id="contenedor">
    <table id="tabla">
      <thead>
        <tr>
          <th>Item</th>
          <th>Cantidad</th>
          <th>Precio Unitario</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        
      </tbody>
      <tfoot>
        <tr>
          <td>Total</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><span id="total">0</span></td>
        </tr>
      </tfoot>
    </table>
    <button type="button" onClick="AddItem();">Agregar item.</button>
  </div>


       </div>

       <div id="linea">
     </div>
       
        <input type="button" id="nuevo" value="Nueva l&iacute;nea"/>
        <input type="button" id="calcular" value="Calcular"/>
           
      </div>

      <div id="material" class="tab-pane">
        material
      </div>

      <div id="manoobra" class="tab-pane">
        mobar
      </div>
    </div>
  </div>
</div>
          </div>  <!--div box -->

        </div>  <!--div span12 container -->



</div> <!--div row -->




 </div>



<script>


function AddItem() {
  var tbody = null;
  var tabla = document.getElementById("tabla");
  var nodes = tabla.childNodes;
  for (var x = 0; x<nodes.length;x++) {
    if (nodes[x].nodeName == 'TBODY') {
      tbody = nodes[x];
      break;
    }
  }
  if (tbody != null) {
    var tr = document.createElement('tr');
    tr.innerHTML = '<td><input type="text" name="item[]"/></td><td><input type="text" name="cantidad[]" onChange="Calcular(this);" value="1" /></td><td><input type="text" name="precunit[]" onChange="Calcular(this);" value="0"/></td><td><input type="text" name="totalitem[]" readonly /></td>';
    tbody.appendChild(tr);
  }
}

function Calcular(ele) {
  var cantidad = 0, precunit = 0, totalitem = 0;
  var tr = ele.parentNode.parentNode;
  var nodes = tr.childNodes;
  for (var x = 0; x<nodes.length;x++) {
    if (nodes[x].firstChild.name == 'cantidad[]') {
      cantidad = parseFloat(nodes[x].firstChild.value,10);
    }
    if (nodes[x].firstChild.name == 'precunit[]') {
      precunit = parseFloat(nodes[x].firstChild.value,10);
    }
    if (nodes[x].firstChild.name == 'totalitem[]') {
      totalitem = parseFloat((precunit*cantidad),10);
      nodes[x].firstChild.value = totalitem;
    }
  }
  var total = document.getElementById("total");
  if (total.innerHTML == 'NaN') {
    total.innerHTML = 0;
  }
  total.innerHTML = parseFloat(total.innerHTML)+totalitem;
}


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
$( "#proyectoactive" ).addClass( "active" );









$("#nuevo").click(function() {
  var i =0;
  $("#linea").append("<div class='row-fluid' id='campos'><div class='span2'><input type='text' class='span15' name='descripcion' id='descripcion'></div><div class='span2'><input type='text' class='span5' name='cantidad'></div><div class='span2'><input type='text' class='span5' name='total'></div></div>");

  i = i+1;
  
});




    
  });   
</script>

@stop


