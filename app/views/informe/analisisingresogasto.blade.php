
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
          <?php 
          $teorico = (int)$teorico[0]->suma; 
          $real = (int)$real[0]->suma2;
          $ingreso = (int)$ingreso[0]->suma3;
          


         
          ?>
          ['Year', 'Presupuesto',{ role: 'annotation' }, 'Gastos',{ role: 'annotation' },"Ingresos",{role: "annotation"}],
         
          ["<?php echo $titulo; ?>",  <?php echo $teorico; ?>, "<?php echo number_format($teorico,0,',','.'); ?>" , <?php echo $real ?>, "<?php echo number_format($real,0,',','.'); ?>",  <?php echo $ingreso ?>, "<?php echo number_format($ingreso,0,',','.'); ?>"]
        ]);




        var options = {
         // title: 'Excavaciones',
          vAxis: {title: '',  titleTextStyle: {color: 'green'}},
           backgroundColor:"white",
            colors:["blue","red", "green"],


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