
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
            <li>Ver Control Gasto</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')




<div class="page-header position-relative">
        <h1>
  Control de gastos

</h1>
</div>
        {{ HTML::link('controlgasto/nuevo', 'Crear Control de  gasto'); }}
 

 <table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr >
            <th>Fecha</th>
            <th>Desc</th>
            <th>Prov</th>
            <th>Doc</th>
            <th>Neto</th>
             <th>Total</th>
             <th>Obra</th>
             <th>Concepto</th>

         
            <th>Acciones</th>
            
          </tr>
        </thead>

        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th class="number1"></th>
                <th class="number1"></th>
                <th class="number1"></th>
                <th class="number1"></th>
                <th></th>
                <th></th>
                 <th></th>
              
            </tr>
        </tfoot>


        <tbody>
  @foreach($controlgastos as $controlgasto)

 

           <tr>
  <td>  {{ date_format(date_create($controlgasto->fecha),'d/m/Y')  }}</td>
  <td>{{ $controlgasto->desc }}</td>
  <td>{{ $controlgasto->proveedor }}</td>
<td>{{ $controlgasto->documento }}</td>
  <td class="number1">{{$controlgasto->neto}}</td>
  <td class="number1">{{ round($controlgasto->neto*1.19) }}</td>
  <td>{{ $controlgasto->obra->nombre }} </td>

  <td>{{ $controlgasto->concepto }} / 
    @if($controlgasto->concepto == "GG")
    {{ $controlgasto->controlgastogg->ggcategoria->nombre}}
    
    @endif

    @if($controlgasto->concepto == "CD")
    {{ $controlgasto->controlgastocd->partida->nombre}}
    
    @endif
     </td>


  <td class="td-actions">
                       
                        


                          <a class="green" href= {{ 'controlgasto/editar/'.$controlgasto->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                          <a class="red bootbox-confirm" data-id={{ $controlgasto->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>
     
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>


  <script type="text/javascript">
/*
 $('#example tfoot th').each( function () {
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" size="1" placeholder="Buscar '+title+'" />' );
        alert(this);
    } );
*/

$(document).ready(function() {

$("#example tfoot th").eq(1).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');
$("#example tfoot th").eq(6).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');
$("#example tfoot th").eq(7).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');



var table  = $('#example').DataTable( {

        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "js/TableTools/swf/copy_csv_xls_pdf.swf",
            "aButtons": [
        {
            "sExtends": "copy",
            "sButtonText": "Copy",
            "oSelectorOpts": {
                page: 'current'
            }
        },

        {
            "sExtends": "xls",
            "sButtonText": "Xls",
            "oSelectorOpts": {
                page: 'current'
            }
        }

    ]
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
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    
                  //  alert(a + b);
                   // $.fn.dataTable.render.number( '\'', '.', 0, '$' );
                    return intVal(a) + intVal(b);

                } );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                pageTotal
            );



            total = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                //''+pageTotal+' ($ '+ total+' total)'
                pageTotal
            );


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


$( "#controlgastoactive" ).addClass( "active" );
$(".number1").prettynumber();



$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('controlgasto/eliminar')}}",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });



}); // fin jquery

 </script>





        


@stop

