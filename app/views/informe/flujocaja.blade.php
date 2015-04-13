
@extends('layouts.master')
 


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
            <li>Ver Flujo</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')




<div class="page-header position-relative">
        <h1>
 Flujo de Caja

</h1>
</div>
   
 

{{$fecha1->fecha}}

{{$fecha2->fecha}}
<?php



$fecha1 = strtotime ( $fecha1->fecha );

//echo $semana=date("W",mktime(0,0,0,$month,$day,$year));
 $semana=date("W",mktime(0,0,0,date("m",$fecha1),date("d",$fecha1),date("Y",$fecha1)));
 $diaSemana=date("w",mktime(0,0,0,date("m",$fecha1),date("d",$fecha1),date("Y",$fecha1)));
echo $primerDia=date("Y-m-d",mktime(0,0,0,date("m",$fecha1),date("d",$fecha1)-$diaSemana+1,date("Y",$fecha1)));

$fecha1 = strtotime($primerDia);

$fecha2 = strtotime( $fecha2->fecha);

$sumagasto =0;
$sumaingreso=0;
$i=0;


echo "<table border='1' width='100%'>";
echo "<th>Dia</th><th>Ingresos</th><th>Gastos</th><th>Total</th>";

while($fecha1 <= $fecha2)
{
   
  
 
	if($i%7==0)
	{
		
	echo "<tr height='50'><td>TOTAL SEMANA</td><td>".$i."</td></tr>";


		
	}
   $i++;

 
   echo "<tr><td>".date('d/m/Y',$fecha1)."</td>";


     $controlingresos = Controlingreso::where("fecha","=",date('Y-m-d',$fecha1))->where("proyecto_id","=", Session::get("proyecto")->id)->select(DB::raw("SUM(neto) as suma1"))->get();
  foreach ($controlingresos as $controlingreso) {
    $sumaingreso = $controlingreso->suma1;
    echo "<td>$controlingreso->suma1</td>";
  }

    $controlgastos = Controlgasto::where("fecha","=",date('Y-m-d',$fecha1))->where("proyecto_id","=", Session::get("proyecto")->id)->select(DB::raw("SUM(neto) as suma2"))->get();
  foreach ($controlgastos as $controlgasto) {
    $sumagasto = $controlgasto->suma2;
    echo "<td>$controlgasto->suma2</td>";
  }




  echo $sumaingreso;
  $totaldia = $sumagasto - $sumaingreso;
  echo "<td>$totaldia</td>";





  echo "</tr>";

	

  $fecha1 = strtotime ( '+1 day' , $fecha1 ) ;
//$fecha1->fecha = date ( 'Y-m-j' , $fecha1->fecha );
	
}

echo "</table>";
?>


  <script type="text/javascript">

$(document).ready(function() {




}); // fin jquery

 </script>





        


@stop

