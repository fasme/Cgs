
@extends('layouts.master')



@section('head')
@parent


<script type="text/javascript" src="https://www.google.com/jsapi"></script>

 <script type="text/javascript">
      google.load("visualization", "1.1", {packages:["bar"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {



        var data = google.visualization.arrayToDataTable([

          ['Categoria', 'Teorico', 'Real', { role: 'annotation' }],
          <?php for($i=0;$i<count($teorico);$i++) { 
            
            ?>

          ["<?php echo 'resumen';?>", {{ $teorico[$i]->valorneto ? $teorico[$i]->valorneto : 0 }}, {{$teorico[$i]->valorneto2 ? $teorico[$i]->valorneto2 : 0}},10],
          
          <?php } ?>

    
         
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
            hAxis:  {title: 'Hello',  titleTextStyle: {color: '#FF0000'}}

          }
        };

        var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

        var chart = new google.charts.Bar(document.getElementById('chart_div'));





  
  //table.draw(data, {allowHtml: true, showRowNumber: true});



        chart.draw(data, options);
      }
    </script>

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


   