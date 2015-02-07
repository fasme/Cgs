
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
            <li>Ver Apu</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')





        <h1>
  Apu

</h1>

 
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr >
            <th>Partida</th>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Precio U</th>
            <th>Cantidad</th>
            <th>Rendimiento</th>
            <th>Costo</th>
            <th>Acciones</th>
            
          </tr>
        </thead>

        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th class="number1"></th>
                <th class="number1"></th>
                <th></th>
                <th class="number1"></th>
                <th></th>
                
              
            </tr>
        </tfoot>


        <tbody>
  @foreach($apus as $apu)

 

           <tr>
  <td>{{ $apu->partida->nombre }} <small class="text-success">{{ $apu->partida->partidacategoria->nombre }}</small></td>
  <td> {{$apu->nombre}}</td>
 <td> 
  @if($apu->categoria == 1)
  I.- MAQUINARIAS, Equipos y Herramientas
  @elseif($apu->categoria == 2)
  II.- MATERIALES POR UNIDAD DE OBRA
  @elseif($apu->categoria == 3)
  III.- MANO DE OBRA.
  @endif
</td>
  <td class="number1">{{$apu->preciou}}</td>

  <td> {{ $apu->cantidad  }} </td>

  <td>{{ number_format($apu->rend,6)  }}</td>

   <td class="number1">{{ $apu->costo  }}</td>
  <td class="td-actions">
                       
                     


                          <a class="green" href= {{ 'apu/editar/'.$apu->partida_id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                          <a class="red bootbox-confirm" data-id={{$apu->id}}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>
     
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>


  <script type="text/javascript">

 $(document).ready(function() {

$("#example tfoot th").eq(1).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');
$("#example tfoot th").eq(0).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');
$("#example tfoot th").eq(2).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');


var table  = $('#example').DataTable( {
  "iDisplayLength": 100,
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "js/TableTools/swf/copy_csv_xls_pdf.swf"
        },
        "footerCallback": function ( row, data, start, end, display ) {
      
          var api = this.api(), data;
     
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
           


            total = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 6 ).footer() ).html(
                //''+pageTotal+' ($ '+ total+' total)'
                pageTotal
            );

            $(".number1").prettynumber();


         }
    } );


// busqueda por cada columna
table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
             table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );

      });



$( "#apuactive" ).addClass( "active" );
$( "#proyectoactive" ).addClass( "active" );

$(".number1").prettynumber();


$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) {
             // bootbox.alert("You are sure!");
             tr.fadeOut(1000);
             $.get("{{ url('apu/eliminar')}}",
              { id: id },
    
      function(data) {
        
      });
            }
          });
        });


});


 </script>




        

        


@stop

