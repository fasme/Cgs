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
            <li>Ver Partidas</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')





        <h1>
  Partidas

</h1>

        
 
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
            <th>Partida</th>
            <th>Item</th>
            <th>Obra</th>
            <th>Cantidad</th>
             <th>Unidad</th>
            <th>Orden</th>
            <th>PU cd oferta</th>
         
            <th>Acciones</th>
  
            
          </tr>
        </thead>


        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              <th></th>
 
              
            </tr>
        </tfoot>


        <tbody>


  @foreach($partidas as $partida)
           <tr>

             <td> {{ $partida->nombre}} <small class="text-success">{{$partida->partidacategoria->nombre}}</small> </td>
            <td> {{  $partida->item }} </td>
             <td> {{  $partida->obra->nombre }} </td>
              <td> {{  $partida->cantidad }} </td>
              <td> {{  $partida->unidad }} </td>
<td> {{  $partida->orden }} </td>
<?php  $suma =0; ?>
  @foreach($partida->apu as $apu)
 
    <?php $suma += round($apu->cantidad*$apu->preciou*(1/$partida->cantidad)); ?>
    
 @endforeach
<td>{{$suma}}</td>
 


  <td class="td-actions">
                       
                      

                          <a class="green" href= {{ 'partidas/editar/'.$partida->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                         <a class="red bootbox-confirm" data-id={{ $partida->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>


  <script type="text/javascript">
 $(document).ready(function() {

$("#example tfoot th").eq(0).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');
$("#example tfoot th").eq(1).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');
$("#example tfoot th").eq(2).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');



var table = $('#example').DataTable( {
  "iDisplayLength": 100,
   "columnDefs": [ 
    {
      "targets":3,
      "render": $.fn.dataTable.render.number( '.', ',', 2, ' ' )
    },
    {
      "targets":6,
      "render": $.fn.dataTable.render.number( '.', ',', 0, '$' )
    }

     ],
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
 
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    
                  //  alert(a + b);
                   // $.fn.dataTable.render.number( '\'', '.', 0, '$' );

                    return intVal(a) + intVal(b);


                } );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

              pageTotal = pageTotal.toFixed(3);                          //-> "1.10"

 
            // Update footer
            var numFormat = $.fn.dataTable.render.number( '.', ',', 3, '$' ).display;

            $( api.column( 3 ).footer() ).html(
                numFormat( pageTotal )
            );
          // $(api.column(6).footer()).removeClass("number1");
          // $(api.column(6).footer()).addClass("number1");
           





         }
    } );


table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
             table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );

      });



$( "#partidasactive" ).addClass( "active" );
$( "#proyectoactive" ).addClass( "active" );

$(".number1").prettynumber();



$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('partidas/eliminar')}}",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricci贸n de clave externa falla");});

     
            }
           
          });
        });





}); // fin ready
 </script>




        

        


@stop

