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
    <button type="button" onClick="AddItem();">Agregar item.</button>
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
    <button type="button" onClick="AddItem2();">Agregar item.</button>
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
    <button type="button" onClick="AddItem3();">Agregar item.</button>
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
    tr.innerHTML = '<td><input type="text" name="nombremaquinaria[]" class="span16"/></td><td><input type="text" class="span10" name="unidad[]"   /></td><td><input type="text" name="preciou[]" class="span10" onChange="Calcular(this);" value="0"/></td><td><input type="text" name="cantidad[]" class="span10" onChange="Calcular(this);" value="1" /></td><td><input class="span10" type="text" name="rendimiento[]"  /></td><td><input type="text" name="costo[]" class="span10"  /></td>';
    tbody.appendChild(tr);
  }
}


function AddItem2() {
  var tbody = null;
  var tabla = document.getElementById("tabla2");
  var nodes = tabla.childNodes;
  for (var x = 0; x<nodes.length;x++) {
    if (nodes[x].nodeName == 'TBODY') {
      tbody = nodes[x];
      break;
    }
  }
  if (tbody != null) {
    var tr = document.createElement('tr');
    tr.innerHTML = '<td><input type="text" name="nombrematerial[]" class="span16"/></td><td><input type="text" class="span10" name="unidad[]"   /></td><td><input type="text" name="preciou[]" class="span10" onChange="Calcular(this);" value="0"/></td><td><input type="text" name="cantidad[]" class="span10" onChange="Calcular(this);" value="1" /></td><td><input class="span10" type="text" name="rendimiento[]"  /></td><td><input type="text" name="costo[]" class="span10"  /></td>';
    tbody.appendChild(tr);
  }
}


function AddItem3() {
  var tbody = null;
  var tabla = document.getElementById("tabla3");
  var nodes = tabla.childNodes;
  for (var x = 0; x<nodes.length;x++) {
    if (nodes[x].nodeName == 'TBODY') {
      tbody = nodes[x];
      break;
    }
  }
  if (tbody != null) {
    var tr = document.createElement('tr');
    tr.innerHTML = '<td><input type="text" name="nombremanoobra[]" class="span16"/></td><td><input type="text" class="span10" name="unidad[]"   /></td><td><input type="text" name="preciou[]" class="span10" onChange="Calcular(this);" value="0"/></td><td><input type="text" name="cantidad[]" class="span10" onChange="Calcular(this);" value="1" /></td><td><input class="span10" type="text" name="rendimiento[]"  /></td><td><input type="text" name="costo[]" class="span10"  /></td>';
    tbody.appendChild(tr);
  }
}

function Calcular(ele) {
  var cantidad = 0, precunit = 0, totalitem = 0, cantidadpartida=0;
  var tr = ele.parentNode.parentNode;
  var nodes = tr.childNodes;
  for (var x = 0; x<nodes.length;x++) {
    if (nodes[x].firstChild.name == 'cantidad[]') {
      cantidad = parseFloat(nodes[x].firstChild.value,6);
    }
    if (nodes[x].firstChild.name == 'preciou[]') {
      precunit = parseFloat(nodes[x].firstChild.value,6);
    }
    

    if (nodes[x].firstChild.name == 'rendimiento[]') {
      cantidadpartida = document.getElementById("cantidadpartida").value;
      
      rendimiento = parseFloat((1/cantidadpartida));
      nodes[x].firstChild.value = rendimiento.toFixed(6);
    }

    if (nodes[x].firstChild.name == 'costo[]') {
      totalitem = parseFloat((precunit*cantidad*rendimiento),6);
      nodes[x].firstChild.value = totalitem.toFixed(0);
    }
  }
  

 
}


  $(document).ready(function(){
   
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












    
  });   
</script>

@stop


