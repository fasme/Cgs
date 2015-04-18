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

<br>



<table width='100%' class='oli'>
	<tr>
<th class='oli'>N</th><th class='oli'>Fecha</th><th class='oli'>Proveedor</th><th class='oli'>Num Factura</th><th class='oli'>Neto</th><th class='oli'>IVA</th><th class='oli'>Impuestos</th><th class='oli'>Descuentos</th><th class='oli'>Total</th>
	</tr>
<?php $num=0; 
$sumatotal=0; 
?>
@foreach($controlgastos as $controlgasto)
<tr>
<?php $num++; 
$sumatotal += (($controlgasto->neto*1.19) + $controlgasto->impuesto - $controlgasto->descuento);
?>
<td class='oli'>{{$num}}</td><td class='oli'>{{date_format(date_create($controlgasto->fecha),'d/m/Y')}}</td><td class='oli'>{{utf8_decode($controlgasto->proveedor)}}</td><td class='oli'>{{$controlgasto->numdocumento}}</td><td class='oli'>{{number_format($controlgasto->neto,0,",",".")}}</td><td class='oli'>{{number_format(($controlgasto->iva),0,",",".")}}</td><td class='oli'>{{number_format($controlgasto->impuesto,0,",",".")}}</td><td class='oli'>{{number_format($controlgasto->descuento,0,",",".")}}</td><td class='oli'>{{number_format($controlgasto->total ,0,",",".")}}</td>
</tr>
@endforeach
<tr><td colspan="8"></td><td class='oli'>{{number_format($sumatotal,0,",",".")}}</td></tr>
</table>
</html>