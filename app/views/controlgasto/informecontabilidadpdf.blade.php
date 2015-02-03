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
		<td>Fecha</td><td>{{ date("d/m/Y") }}</td>
	</tr>
	<tr>
		<td>Firma</td><td>_____________</td>
	</tr>

</table>

<br>



<table width='100%' class='oli'>
	<tr>
<th class='oli'>N</th><th class='oli'>Fecha</th><th class='oli'>Proveedor</th><th class='oli'>Factura</th><th class='oli'>Neto</th><th class='oli'>IVA</th><th class='oli'>Total</th>
	</tr>
<?php $num=0; ?>
@foreach($controlgastos as $controlgasto)
<tr>
<?php $num++; ?>
<td class='oli'>{{$num}}</td><td class='oli'>{{date_format(date_create($controlgasto->fecha),'d/m/Y')}}</td><td class='oli'>{{utf8_decode($controlgasto->proveedor)}}</td><td class='oli'>{{$controlgasto->numdocumento}}</td><td class='oli'>{{number_format($controlgasto->neto,0,",",".")}}</td><td class='oli'>{{number_format(($controlgasto->neto)*0.19,0,",",".")}}</td><td class='oli'>{{number_format($controlgasto->neto*1.19,0,",",".")}}</td>
</tr>
@endforeach

</table>
</html>