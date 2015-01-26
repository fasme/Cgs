

<html>
<table  width='1000' >
<tr>
<td><img src='avatars/logo1.png' width='100'></td>
<td>ORDEN DE COMPRA N {{ $ordenes->id}}</td>
<td>Fecha {{ $ordenes->fecha}}</td>
</table>

<table width='1000'>

	<tr>
<td rowspan='6' width='20'>PROVEEDOR</td>
<td colspan='2' >Nombre</td>
<td colspan='3'>{{$ordenes->proveedor->nombre}}</td>
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
<td >{{$ordenes->proveedor->email}}</td>
</tr>
<tr>
<td>Direccion</td>
<td >{{$ordenes->proveedor->direccion}}</td>
</tr>
<tr>
<td >Ciudad</td>
<td >{{$ordenes->proveedor->ciudad}}</td>
</tr>

<tr>
<td colspan='3'></td>

</tr>

<tr>
<td>Obra COD</td>
<td colspan='8'>CONTRATO DE CONSTRUCCION A SUMA ALZADA PUENTES 1 Y 3,                                        LOS PEUMOS DE PEÑUELAS PLACILLA-VALPARAISO</td>

</tr>

<tr>
<td colspan='3'><br></td>

</tr>


<tr>
	<td>Item</td><td>Material/Insumo</td><td>Cantidad</td><td>Unidad de </td><td>Valor Unitario</td><td>Valor Total</td>
</tr>
<?php $neto=0; 
	$num =0;
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
			<td>Neto</td>
			<td>{{$neto}}</td>
	</tr>
	<tr>
			<td colspan='4'></td>
			<td>IVA</td>
			<td>{{($neto*19)/100}}</td>
	</tr>
	<tr>
			<td colspan='4'></td>
			<td>TOTAL</td>
			<td>{{($neto*19)/100 + $neto}}</td>
	</tr>
</table>


</html>