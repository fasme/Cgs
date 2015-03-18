
@extends('layouts.master')



@section('head')
@parent


@stop
@section('breadcrumb')



<ul class="breadcrumb">
            <li>
              <i class="fa fa-home home-fa fa"></i>
              <a href="#">Home</a>

              <span class="divider">
                <i class="fa fa-angle-right arrow-fa fa"></i>
              </span>
            </li>

           <li>
              <a href={{ URL::to('proyectos') }}>{{ Session::get('proyecto')->nombre}}</a>

              <span class="divider">
                <i class="fa fa-angle-right arrow-fa fa"></i>
              </span>
            </li>
            <li>Ver Informe Analisis de costos</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')




<div class="page-header position-relative">
        <h1>
  Informe 

<small><i class="fa fa-angle-double-right"></i>
	Analisis de costos</small>
</h1>

</div>



 
<h3 class="header smaller lighter green">Gastos Generales</h3>

<table border='0' width="500">

<tr><td>Resumen</td><td>Detalle</td><td>Resumen Mensual</td></tr>
<tr>
  <td><a href="{{URL::to('informes/analisiscosto/resumen')}}"><img src={{asset('img/graph/Goingdown128.png')}} alt="Logo"></a></td>
 <td><a href="{{URL::to('informes/analisiscosto/detalle')}}"><img src={{asset('img/graph/Goingdown128.png')}} alt="Logo"></a></td>
  <td><a href="{{URL::to('informes/analisiscosto/resumenmensual')}}"><img src={{asset('img/graph/Goingdown128.png')}} alt="Logo"></a></td>
  
</tr>
</table>


<h3 class="header smaller lighter green">TOTAL</h3>


<table border='0' width="500">
@foreach (Session::get("proyecto")->obra as $teoricos)

@endforeach

<tr>
  <tr><th>Excavaciones</th><th>Rellenos Estructurales</th><th>Hormigones</th><th>Otros</th></tr>
  <td><a href="{{URL::to('informes/analisiscosto/cdexcavacion/ALL')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
 <td><a href="{{URL::to('informes/analisiscosto/cdrellenos/ALL')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
  <td><a href="{{URL::to('informes/analisiscosto/cdhormigon/ALL')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
  <td><a href="{{URL::to('informes/analisiscosto/cdotros/ALL')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
  
</tr>
<tr>
  <tr><th>Acero</th><th>Moldajes</th><th>Enrocados</th></tr>
  <td><a href="{{URL::to('informes/analisiscosto/cdacero/ALL')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
 <td><a href="{{URL::to('informes/analisiscosto/cdmoldaje/ALL')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
  <td><a href="{{URL::to('informes/analisiscosto/cdenrocado/ALL')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
  
</tr>
</table>


<h3 class="header smaller lighter green">Costos Directos Puente 1</h3>


<table border='0' width="500">
@foreach (Session::get("proyecto")->obra as $teoricos)

@endforeach

<tr>
  <tr><th>Excavaciones</th><th>Rellenos Estructurales</th><th>Hormigones</th><th>Otros</th></tr>
  <td><a href="{{URL::to('informes/analisiscosto/cdexcavacion/1')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
 <td><a href="{{URL::to('informes/analisiscosto/cdrellenos/1')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
  <td><a href="{{URL::to('informes/analisiscosto/cdhormigon/1')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
  <td><a href="{{URL::to('informes/analisiscosto/cdotros/1')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
  
</tr>
<tr>
  <tr><th>Acero</th><th>Moldajes</th><th>Enrocados</th></tr>
  <td><a href="{{URL::to('informes/analisiscosto/cdacero/1')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
 <td><a href="{{URL::to('informes/analisiscosto/cdmoldaje/1')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
  <td><a href="{{URL::to('informes/analisiscosto/cdenrocado/1')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
  
</tr>
</table>


<h3 class="header smaller lighter green">Costos Directos Puente 3</h3>


<table border='0' width="500">
@foreach (Session::get("proyecto")->obra as $teoricos)

@endforeach

<tr>
  <tr><th>Excavaciones</th><th>Rellenos Estructurales</th><th>Hormigones</th><th>Otros</th></tr>
  <td><a href="{{URL::to('informes/analisiscosto/cdexcavacion/2')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
 <td><a href="{{URL::to('informes/analisiscosto/cdrellenos/2')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
  <td><a href="{{URL::to('informes/analisiscosto/cdhormigon/2')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
  <td><a href="{{URL::to('informes/analisiscosto/cdotros/2')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
  
</tr>
<tr>
  <tr><th>Acero</th><th>Moldajes</th><th>Enrocados</th></tr>
  <td><a href="{{URL::to('informes/analisiscosto/cdacero/2')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
 <td><a href="{{URL::to('informes/analisiscosto/cdmoldaje/2')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
  <td><a href="{{URL::to('informes/analisiscosto/cdenrocado/2')}}"><img src={{asset('img/graph/pie1128.png')}} alt="Logo"></a></td>
  
</tr>
</table>





@stop

