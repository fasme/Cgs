
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
            <li>Ver Cheques</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')





        <h1>
  Cheques

</h1>

 
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr >
            <th>Obra</th>
            <th>Proveedor</th>
            
            <th>Monto</th>
            <th>N Cheque</th>
            <th>Fecha Pago</th>
            <th>Estado</th>
            <th>Revision</th>
            <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>
  @foreach($cheques as $cheque)

 

           <tr><td>
        


                    {{  $cheque->obra->nombre }}
                    <br>
            /
            @if ($cheque->controlgasto->concepto == "GG")
            {{ $cheque->controlgasto->controlgastogg->ggcategoria->nombre }}
            @endif

             @if ($cheque->controlgasto->concepto == "CD")
            {{ $cheque->controlgasto->controlgastocd->partida->nombre }}
            @endif
           
    
      
  </td>
  <td> {{ $cheque->controlgasto->proveedor }}
 
</td>
 
  <td class="number1">{{$cheque->controlgasto->neto}}</td>
<td>{{ $cheque->numero }}</td>
  <td> {{ date_format(date_create($cheque->fechapago),'d/m/Y')  }} </td>

  <td>

  @if (date("Y-m-d") < $cheque->fechapago) 
 <span class="label label-success arrowed-in">
 Vigente 



{{CalcularDiasCheque($cheque->fechapago)}}

 </span>
  @else
  <span class="label label-inverse arrowed arrowed-righ">
 Vencido
 </span>
  @endif
</td>

   <td>
@if ( $cheque->revision === "1")
<span class="label label-success">
   Revisado
   </span>

@elseif ( $cheque->revision === "2")
<span class="label label-warning">
   Revisar
   </span>

@elseif ( $cheque->revision === "3")
<span class="label label-warning">
   Pendiente
   </span>


@endif


  </td>
  <td class="td-actions">
                       
                     


                          <a class="green" href= {{ 'controlgasto/editar/'.$cheque->controlgasto_id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                          <a class="red bootbox-confirm" data-id={{$cheque->id}}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>
     
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>


  <script type="text/javascript">

 $(document).ready(function() {

$('#example').DataTable( {
  "iDisplayLength": 100,

   "columnDefs": [ {
      "targets": 4,
      "type": 'date-eu'
    } ],

        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "js/TableTools/swf/copy_csv_xls_pdf.swf"
        }
    } );

$( "#chequeactive" ).addClass( "active" );
$(".number1").prettynumber();


$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) {
             // bootbox.alert("You are sure!");
             tr.fadeOut(1000);
             $.get("{{ url('cheques/eliminar')}}",
              { id: id },
    
      function(data) {
        
      });
            }
          });
        });


});


 </script>




        

        


@stop

