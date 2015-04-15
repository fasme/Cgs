
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
   
 


<?php



$fecha1 = strtotime ( $fecha1->fecha );

//echo $semana=date("W",mktime(0,0,0,$month,$day,$year));
 $semana=date("W",mktime(0,0,0,date("m",$fecha1),date("d",$fecha1),date("Y",$fecha1)));
 $diaSemana=date("w",mktime(0,0,0,date("m",$fecha1),date("d",$fecha1),date("Y",$fecha1)));
 $primerDia=date("Y-m-d",mktime(0,0,0,date("m",$fecha1),date("d",$fecha1)-$diaSemana+1,date("Y",$fecha1)));

$fecha1 = strtotime($primerDia);

$fecha2 = strtotime( $fecha2->fecha);

$sumagasto =0;
$sumaingreso=0;
$totaldia=0;
$i=0;
$sumasemanaingreso=0;
$sumasemanagasto=0;
$sumacheque =0;
$sumasemanacheque=0;



echo "<table border='1' width='100%' id='example' class='table table-striped table-bordered table-hover'>";
echo "<thead><th>Dia</th><th>Ingresos</th><th>Gastos</th><th>Total</th></thead>";

echo "<tbody>";
while($fecha1 <= $fecha2)
{
   
  
  if($i%7==0)
  {
    
    if($i>0) // para k no salga la primera fila
    {
      $sumasemana = $sumasemanaingreso - $sumasemanagasto;
      echo "<tr height='50' bgcolor='#FBFBEF'><td>TOTAL SEMANA</td><td></td><td></td><td>".number_format($sumasemana,0,",",".")."</td></tr>";
      $sumasemanaingreso =0;
      $sumasemanagasto=0;
    }
  


    
  }
   $i++;


  
  $dia=date("l",$fecha1);

if ($dia=="Monday") $dia="Lunes";
if ($dia=="Tuesday") $dia="Martes";
if ($dia=="Wednesday") $dia="Miércoles";
if ($dia=="Thursday") $dia="Jueves";
if ($dia=="Friday") $dia="Viernes";
if ($dia=="Saturday") $dia="Sabado";
if ($dia=="Sunday") $dia="Domingo";

   echo "<tr><td><p class='alertita text-info' data-fecha='$fecha1'>$dia ".date('d/m/Y',$fecha1)."</p></td>";


    $controlingresos = Controlingreso::where("fecha","=",date('Y-m-d',$fecha1))->where("proyecto_id","=", Session::get("proyecto")->id)->select(DB::raw("SUM(neto) as suma1"))->get();
  foreach ($controlingresos as $controlingreso) {
    $sumaingreso = $controlingreso->suma1;
    $sumasemanaingreso += $sumaingreso;
    echo "<td>".number_format($sumaingreso,0,",",".")."</td>";
  

}

 // gasto con cheque
/*
$cheques = Controlgasto::leftjoin("cheque","cheque.controlgasto_id","=","controlgasto.id")->where("fechapago","=",date("Y-m-d",$fecha1))->where("controlgasto.proyecto_id","=", Session::get("proyecto")->id)->select(DB::raw("SUM(neto) as suma3"))->get();
  foreach ($cheques as $cheque)
  {
    $sumacheque = $cheque->suma3;
    $sumasemanacheque += $sumacheque;

  }
  */


    // gastos sin cheques
    $controlgastos = Controlgasto::where("fecha","=",date('Y-m-d',$fecha1))->where("proyecto_id","=", Session::get("proyecto")->id)->select(DB::raw("SUM(neto) as suma2"))->whereIn("tipopago",array("1","3","4","2"))->get();
  foreach ($controlgastos as $controlgasto) {
    $sumagasto = $controlgasto->suma2;
    $sumasemanagasto += $sumagasto;

   // $sumagastototal = $sumacheque + $sumagasto;
    echo "<td>".number_format($sumagasto,0,",",".")."</td>";
  }

  







  $totaldia += $sumaingreso - $sumagasto;
  if($totaldia <0)
  {
    echo "<td><font color='red'>".number_format($totaldia,0,",",".")."</font></td>";
  }
  else
  {
  echo "<td><font color='green'>".number_format($totaldia,0,",",".")."</font></td>";
  }
  





  echo "</tr>";

	

  $fecha1 = strtotime ( '+1 day' , $fecha1 ) ;
//$fecha1->fecha = date ( 'Y-m-j' , $fecha1->fecha );
	



}
echo "</tbody>";
echo "</table>";
?>


  <script type="text/javascript">

$(document).ready(function() {

 $('#example').DataTable( {
"iDisplayLength": -1,
"ordering": false,

dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "../../../js/TableTools/swf/copy_csv_xls_pdf.swf"
           
  },


});




$(".alertita").click(function(){

    

    ;
    var fecha = $(this).data("fecha");
    $.get("{{ url('buscarFechaFlujo')}}", {fecha: fecha},
              function(data) {

              bootbox.alert(data, function() {
    })
      });




});




}); // fin jquery

 </script>





        


@stop

