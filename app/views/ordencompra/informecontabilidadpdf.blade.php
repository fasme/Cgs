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
<th class='oli'>N</th><th class='oli'>Fecha</th><th class='oli'>Proveedor</th><th class='oli'>Neto</th><th class='oli'>IVA</th><th class='oli'>Total</th>
	</tr>
	<?php $num =0; ?>
@foreach($ordenes as $orden)
<tr>
	<?php $neto=0; 
	
	$num++;
	?>
	@foreach ($orden->ordencompradetalle as $detalle)

	

	<?php  $neto += $detalle->cantidad*$detalle->valoru; 
	
	?>
	

	@endforeach

<td class='oli'>{{$num}}</td><td class='oli'>{{date_format(date_create($orden->fecha),'d/m/Y') }}</td><td class='oli'>{{$orden->proveedor->nombre}}</td><td class='oli'>{{number_format($neto,0,",",".")}}</td><td class='oli'>{{number_format(($neto*19)/100,0,",",".")}}</td><td class='oli'>{{number_format(($neto*19)/100 + $neto,0,",",".")}}</td>
</tr>
@endforeach

</table>
</html>