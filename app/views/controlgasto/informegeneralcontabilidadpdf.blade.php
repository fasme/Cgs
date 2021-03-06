<style>

.oli{
	
border: 1px solid black;
	 
}

table, th, td{

	
}


.letrachica { 
  font: 70% arial; 
}
}
</style>

<html>
<table width='100%' class='oli'>

	<tr>
<td rowspan="2"><img src='avatars/cgs.jpg' width='50'></td>

		<td>
{{utf8_decode(Session::get("proyecto")->nombre) }}
</td>
	</tr>

	<tr><td>Periodo: {{$mes." / ".$ano }}</td></tr>
	

</table>

<?php


//ACTUAL

//
 $cantfacturasGasto = Controlgasto::where('periodomes',"=", $mes)
      ->where("periodoano","=",$ano)
    ->where('documento',"=",2)
    ->orwhere("documento","=",6)
    ->where("proyecto_id","=",Session::get("proyecto")->id)
    ->orderby("fecha")
    ->count();

  $cantfacturasIngreso = Controlingreso::where('periodomes',"=", $mes)
      ->where("periodoano","=",$ano)
    ->where('documento',"=",2)
    ->orwhere("documento","=",6)
    ->where("proyecto_id","=",Session::get("proyecto")->id)
    ->orderby("fecha")
    ->count();

    $ivafacturasIngreso = Controlingreso::where('periodomes',"=", $mes)
      ->where("periodoano","=",$ano)
    ->where('documento',"=",2)
    ->orwhere("documento","=",6)
    ->where("proyecto_id","=",Session::get("proyecto")->id)
    ->orderby("fecha")
    ->sum("iva");

     $ivafacturasGasto = ControlGasto::where('periodomes',"=", $mes)
      ->where("periodoano","=",$ano)
    ->where('documento',"=",2)
    ->orwhere("documento","=",6)
    ->where("proyecto_id","=",Session::get("proyecto")->id)
    ->orderby("fecha")
    ->sum("iva");


    $netofacturasIngreso = Controlingreso::where('periodomes',"=", $mes)
      ->where("periodoano","=",$ano)
    ->where('documento',"=",2)
    ->orwhere("documento","=",6)
    ->where("proyecto_id","=",Session::get("proyecto")->id)
    ->orderby("fecha")
    ->sum("neto");

    $ppm = 2.14;

    $ppmneto = $ppm *$netofacturasIngreso;

   

   // ANTERIOR
if($mes == 1)
{
  $mesanterior = 12;
  $anoanterior = $ano-1;
}
else
{
  $mesanterior = $mes-1;
  $anoanterior = $ano;
}


$netofacturasIngresoAnterior = Controlingreso::where('periodomes',"=", $mesanterior)
      ->where("periodoano","=",$anoanterior)
    ->where('documento',"=",2)
    ->orwhere("documento","=",6)
    ->where("proyecto_id","=",Session::get("proyecto")->id)
    ->orderby("fecha")
    ->sum("neto");

$ppmnetoAnterior = $netofacturasIngresoAnterior * $ppm;
$subtotalAnterior = $retimpunico + $rettasas + $ppmnetoAnterior;

// FIN ANTERIOR

 $remanente = ($ivafacturasIngreso - $ivafacturasGasto) + $subtotalAnterior;

    $totalcredito = $ivafacturasGasto + $remanente;

    $subtotal = $retimpunico + $rettasas + $ppmneto;















?>


<div style="position: absolute;top: 100px; left: 0px;">
<table width='50%' class='oli'>
	<tr><th class='oli'>Glosa</th><th class='oli'>Valor</th></tr>
<tr><td class='oli letrachica'>Cantidad facturas emitidas</td> <td class='oli'>				{{ $cantfacturasIngreso}}</td></tr>
<tr><td class='oli letrachica'>Cant. de dctos. fact. recib. del giro</td> <td class='oli'> {{ $cantfacturasGasto }}</td></tr>
<tr><td class='oli letrachica'>Remanente de credito fisc</td> <td class='oli'>				{{ number_format($subtotalAnterior,0,",",".") }}</td></tr>
<tr><td class='oli letrachica'>Ret. Imp. Unico Trab. art. 74 N Lir</td> <td class='oli'>	{{number_format($retimpunico,0,",",".")}}</td></tr>
<tr><td class='oli letrachica'>Ret. Tasas de 10% sobre las rent.</td> <td class='oli'>		{{number_format($rettasas,0,",",".")}}</td></tr>
<tr><td class='oli letrachica'>Base imponible</td> <td class='oli'>							{{number_format($netofacturasIngreso,0,",",".")}}</td></tr>
<tr><td class='oli letrachica'>Tassa PPM 1ra categ.</td> <td class='oli'>					{{number_format($ppm,2,",",".")}}</td></tr>
<tr><td class='oli letrachica'>Rem Cred Capacitacion Periodo Siguiente</td> <td class='oli'></td></tr>
<tr><td class='oli letrachica'>Remanente Ant. Cambio Per Sgte</td> <td class='oli'></td></tr>
</table>
</div>

<div style="position: absolute;top: 100px; left: 370px;">
<table width='100%' class='oli'>
	<tr><th class='oli'>Glosa</th><th class='oli'>Valor</th></tr>
<tr><td class='oli letrachica'> Debitos Facturas Emitidas</td><td class='oli'>				{{number_format($ivafacturasIngreso,0,",",".")}}</td></tr>
<tr><td class='oli letrachica'> Total Debitos<td class='oli'>							{{number_format($ivafacturasIngreso,0,",",".")}}</td></tr>
<tr><td class='oli letrachica'> Credito Rec. Y REeint Fact Del Giro</td><td class='oli'>		{{number_format($ivafacturasGasto,0,",",".")}}</td></tr>
<tr><td class='oli letrachica'> Remanente Credito Mes Anterior</td><td class='oli'>				{{number_format($remanente,0,",",".")}}</td></tr>
<tr><td class='oli letrachica'> Postergacion Pago IVA</td><td class='oli'></td></tr>
<tr><td class='oli letrachica'> Total Creditos</td><td class='oli'>								{{number_format($totalcredito,0,",",".")}}</td></tr>
<tr><td class='oli letrachica'> PPM Neto Det.</td><td class='oli'>								{{number_format($ppmneto,0,",",".")}}</td></tr>
<tr><td class='oli letrachica'> Total Credito Capacitacion a Imputar</td><td class='oli'></td></tr>
<tr><td class='oli letrachica'> Sub Total IMP Determinado Anverso</td><td class='oli'>			{{number_format($subtotal,0,",",".")}}</td></tr>
<tr><td class='oli letrachica'> Total Determinado</td><td class='oli'></td></tr>
<tr><td class='oli letrachica'> Anticipo a Imputar</td><td class='oli'></td></tr>



</table>
</div>
</html>