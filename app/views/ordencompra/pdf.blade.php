<style>

.oli{
	

	 
}

table, th, td{

	border: 1px solid black;
}
}
</style>

<html>
<table border='0' width='100%' >
<tr>
<td><img src='avatars/logo1.png' width='100'></td>
<td>ORDEN DE COMPRA N {{ $ordenes->id}}</td>
<td>Fecha {{ date_format(date_create($ordenes->fecha),'d/m/Y') }}</td>
</table>

<table  width='100%'>

	<tr>
<td rowspan='6' width='20%'>PROVEEDOR</td>
<td width='30%'>Nombre</td>
<td width='50%'>{{$ordenes->proveedor->nombre}}</td>
</tr>
<tr>
<td>RUT</td>
<td>{{$ordenes->proveedor->rut}}</td>
</tr>
<tr>
<td>Fono</td>
<td>{{$ordenes->proveedor->fono}}</td>
</tr>
<tr>
<td>Email</td>
<td>{{$ordenes->proveedor->email}}</td>
</tr>
<tr>
<td>Direccion</td>
<td>{{$ordenes->proveedor->direccion}}</td>
</tr>
<tr>
<td>Ciudad</td>
<td>{{$ordenes->proveedor->ciudad}}</td>
</tr>

<tr>
<td colspan='3'><br></td>

</tr>

<tr bgcolor='#DDD9C3'>
<td>Obra COD</td>
<td colspan='2'>CONTRATO DE CONSTRUCCION A SUMA ALZADA PUENTES 1 Y 3,LOS PEUMOS DE {{ utf8_decode("PEÑUELAS")}} PLACILLA-VALPARAISO</td>

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
	
	<td> {{ $num++ }}</td>
	<td> {{ $orden->nombre }}</td>
	<td> {{ $orden->cantidad }}</td>
	<td> {{ $orden->medida }}</td>
	<td> {{ $orden->valoru }}</td>
	<td> {{ $orden->cantidad * $orden->valoru }}</td>

	<?php $neto += $orden->cantidad * $orden->valoru ?>
	

	</tr>
	@endforeach

	<tr>
			<td colspan='4'></td>
			<td><b>Neto</b></td>
			<td>{{$neto}}</td>
	</tr>
	<tr>
			<td colspan='4'></td>
			<td><b>IVA</b></td>
			<td>{{($neto*19)/100}}</td>
	</tr>
	<tr>
			<td colspan='4'></td>
			<td><b>TOTAL</b></td>
			<td><b>{{($neto*19)/100 + $neto}}</b></td>
	</tr>
</table>



</html>