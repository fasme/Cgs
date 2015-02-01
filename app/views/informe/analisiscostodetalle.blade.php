
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
 
          ['Year', 'Teorico', 'Real'],
          <?php for($i=0; $i<count($categorias); $i++) { ?>
          ["{{$categorias[$i]->nombre}}", <?php  if($teorico[$i]->valorneto == null) { echo 0;} else { echo $teorico[$i]->valorneto;} ?>, <?php  if($real[$i]->valorneto == null) { echo 0;} else { echo $real[$i]->valorneto;} ?>],

          <?php } ?>
        ]);




        var options = {
          title: 'Analisis de costo Detalle',
          vAxis: {title: 'Detalle',  titleTextStyle: {color: 'red'}}
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