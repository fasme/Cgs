
@extends('layouts.master')



@section('head')
@parent


<script type="text/javascript" src="https://www.google.com/jsapi"></script>




<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
        

          ['Year', 'Teorico', { role: 'annotation' }, 'Real',{ role: 'annotation' }],
          <?php for($i=0; $i<count($real); $i++) { ?>
          ["{{$real[$i]->mes.'/'.$real[$i]->ano}}", <?php   echo $teorico[0]->valorneto/7; ?>,"<?php echo number_format($teorico[0]->valorneto/7,0,',','.'); ?>", <?php  echo $real[$i]->valorneto2; ?>,"<?php echo number_format($real[$i]->valorneto2,0,',','.'); ?>"],

          <?php } ?>
        ]);




        var options = {
          title: 'Analisis de costo Resumen Mensual',
          vAxis: {title: 'Meses',  titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>
  </head>




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
              <a href={{ URL::to('informes') }}>Informes</a>

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




     <div id="chart_div" style="width: 900px; height: 500px;"></div>



@stop