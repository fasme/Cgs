
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



 


<table border='0'>
@foreach (Session::get("proyecto")->obra as $teoricos)
<tr>
<td><a href={{ URL::to('informes/analisiscosto/'.$teoricos->id) }}>Ver informe de {{ $teoricos->nombre }}</a></td>
</tr>
@endforeach
<tr>
  <td><a href={{ URL::to('informes/analisiscosto/resumen') }}>Ver informe de Gastos Generales Resumen</a></td>
  </tr>
  <tr>
  <td><a href={{ URL::to('informes/analisiscosto/detalle') }}>Ver informe de Gastos Generales Detalle</a></td>
  </tr>
</table>




@stop

