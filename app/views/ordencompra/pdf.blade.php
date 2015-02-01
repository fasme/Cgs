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
<title>Orden de compra </title>
<table border='0' width='100%' >
<tr>
<td><img src='avatars/logo1.png' width='100'></td>
<td>ORDEN DE COMPRA N {{ $ordenes->id}}</td>
<td>Fecha {{ date_format(date_create($ordenes->fecha),'d/m/Y') }}</td>
</table>

<table  width='100%' class="oli">

	<tr>
<td rowspan='6' width='20%' class="oli">PROVEEDOR</td>
<td width='30%' class="oli">Nombre</td>
<td width='50%' class="oli">{{$ordenes->proveedor->nombre}}</td>
</tr>
<tr>
<td class="oli">RUT</td>
<td class="oli">{{$ordenes->proveedor->rut}}</td>
</tr>
<tr>
<td class="oli">Fono</td>
<td class="oli">{{$ordenes->proveedor->fono}}</td>
</tr>
<tr>
<td class="oli">Email</td>
<td class="oli">{{$ordenes->proveedor->email}}</td>
</tr>
<tr>
<td class="oli">Direccion</td>
<td class="oli">{{$ordenes->proveedor->direccion}}</td>
</tr>
<tr>
<td class="oli">Ciudad</td>
<td class="oli">{{$ordenes->proveedor->ciudad}}</td>
</tr>

<tr>
<td colspan='3'><br></td>

</tr>

<tr bgcolor='#DDD9C3'>
<td class="oli">Obra COD</td>
<td colspan='2' class="oli">CONTRATO DE CONSTRUCCION A SUMA ALZADA PUENTES 1 Y 3,LOS PEUMOS DE {{ utf8_decode("PEÑUELAS")}} PLACILLA-VALPARAISO</td>

</tr>

<tr>
<td colspan='3'><br></td>

</tr>


	</table>


	<table width='100%'>

<tr>
	<th>Item</th><th>Material/Insumo</th><th>Cantidad</th><th>Unidad de </th><th>Valor Unitario</th><th>Valor Total</th>
</tr>

<?php $neto=0; 
	$num =1;
	?>
@foreach ($ordenes->ordencompradetalle as $orden)
<tr>
	
	<td class="oli"> {{ $num++ }}</td>
	<td class="oli"> {{ $orden->nombre }}</td>
	<td class="oli"> {{ $orden->cantidad }}</td>
	<td class="oli"> {{ $orden->medida }}</td>
	<td class="oli"> {{ number_format($orden->valoru,0,",",".") }}</td>
	<td class="oli"> {{ number_format($orden->cantidad * $orden->valoru,0,",",".") }}</td>

	<?php $neto += $orden->cantidad * $orden->valoru ?>
	

	</tr>
	@endforeach

	<tr>
			<td colspan='4'></td>
			<td class="oli"><b>Neto</b></td>
			<td class="oli">{{number_format($neto,0,",",".")}}</td>
	</tr>
	<tr>
			<td colspan='4'></td>
			<td class="oli"><b>IVA</b></td>
			<td class="oli">{{number_format(($neto*19)/100,0,",",".")}}</td>
	</tr>
	<tr>
			<td colspan='4'></td>
			<td class="oli"><b>TOTAL</b></td>
			<td class="oli"><b>{{number_format(($neto*19)/100 + $neto,0,",",".")}}</b></td>
	</tr>
</table>

<br>

<table width="100%" class="oli">
	<tr><td width='35%'><b>CONTACTO ENTREGA: </b>	</td><td width='65%'></td></tr>
	<tr><td class="letrachica">TEL. CEL.</td><td>{{$ordenes->telcel}}</td></tr>
	<tr><td class="letrachica">MERCADERIA PUESTA EN:</td><td>{{$ordenes->mercaderia}}</td></tr>
<tr><td class="letrachica">FECHA DE ENTREGA:</td><td>{{ date_format(date_create($ordenes->fechaentrega),'d/m/Y') }}</td></tr>
<tr><td class="letrachica">COND. DE PAGO:</td><td>{{$ordenes->pago}}</td></tr>
</table>

<table width="100%" class="oli">
	<tr><td width='90%'><b>DATOS FACTURACION: </b>	</td><td width='10%'></td></tr>
	<tr><td class="letrachica">CONSTRUCTORA CGS LTDA.</td><td></td></tr>
	<tr><td class="letrachica">76.336.080-6</td><td></td></tr>
<tr><td class="letrachica">FRANCISCO RUIZ TAGLE {{ utf8_decode("N º")}}531, CERRO EL LITRE, VALPARAISO.</td><td></td></tr>
<tr><td class="letrachica">GIRO: CONSTRUCCION</td><td></td></tr>
<tr><td class="letrachica">FONO: 32 3116482</td><td></td></tr>

<tr>
<td colspan='3'><br></td>

</tr>

<tr><td class="letrachica"><b>Notas:</b></td><td></td></tr>
<tr><td class="letrachica">1. Toda factura debe indicar {{ utf8_decode("N º")}} OC y nombre de la obra.:</td><td></td></tr>
<tr><td class="letrachica">2. Proveedores, consultas y pagos los dias viernes de 15:00 a 18:00 horas.  </td><td></td></tr>

</table>


<br><br><br><br><br><br><br><br>
<table border="0" width="100%">
	<tr align="center"><td class="letrachica"><b>DANIEL GALAZ B.</b></td></tr>
	<tr align="center"><td class="letrachica"><b>ADMINISTRADOR DE OBRA</b></td></tr>
	<tr align="center"><td class="letrachica"><b>CONSTRUCTORA CGS LTDA.</b></td></tr>
</table>

</html>