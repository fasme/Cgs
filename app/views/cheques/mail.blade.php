Cheques
<table width='50%'>

<td>Fecha Pago</td><td>Numero de cheque</td>
@foreach($cheques as $cheque)

<tr>

<td>{{date_format(date_create($cheque->fechapago),'d/m/Y')}}</td><td>{{$cheque->numero}}</td>
</tr>
@endforeach


</table>