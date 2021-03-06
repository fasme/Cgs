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
            <li>Ver Gastos Generales</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')





        <h1>
  Gastos generales

</h1>
        {{ HTML::link('gastogeneral/nuevo', 'Crear gasto general'); }}
 
 <div class="row-fluid">


                <div class="table-header">
                  Resultados
                </div>
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr >
          
            <th>Categoria</th>
            <th>Nombre</th>
            <th>Unidad</th>
            <th>Cantidad</th>
            <th>Precio</th>
         <th>Total</th>
            <th>Acciones</th>
            
          </tr>
        </thead>


        <tfoot>
            <tr>
             
                <th></th>
                <th class=""></th>
                <th class=""></th>
                <th class=""></th>
                <th class="number1"></th>
                <th class="number1"></th>
            <th class=""></th>
              
            </tr>
        </tfoot>



        <tbody>
  @foreach($gg as $gastos)
  <tr>
 
    <td>{{ $gastos->ggcategoria->nombre }}</td>
  <td> {{ $gastos->nombre }}</td>
  <td>{{ $gastos->unidad }}</td>
  <td>{{ $gastos->cantidad }}</td>
  <td class="number1">{{$gastos->precio}}</td>
<td class="number1">{{$gastos->precio * $gastos->cantidad}}</td>
  <td class="td-actions">
                       
                          <a class="blue" href={{'gastogeneral/'.$gastos->id }}>
                            <i class='fa fa-zoom-in bigger-130'></i>
                          </a>


                          <a class="green" href= {{ 'gastogeneral/editar/'.$gastos->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                          <a class="red bootbox-confirm" data-id={{ $gastos->id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>
     
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>
</div>

  <script type="text/javascript">
 $(document).ready(function() {



$("#example tfoot th").eq(0).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');
$("#example tfoot th").eq(1).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');


var table = $('#example').DataTable( {
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
 
            // Total over all pages
            total = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    
                  //  alert(a + b);
                   // $.fn.dataTable.render.number( '\'', '.', 0, '$' );

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
                pageTotal
            );
           $(api.column(6).footer()).removeClass("number1");
           $(api.column(6).footer()).addClass("number1");
           




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
            $(".number1").prettynumber();


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


$( "#gastogeneralactive" ).addClass( "active" );
$( "#proyectoactive" ).addClass( "active" );



$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) {
             // bootbox.alert("You are sure!");
             tr.fadeOut(1000);
             $.get("{{ url('gastogeneral/eliminar')}}",
              { id: id },
    
      function(data) {
        
      });
            }
          });
        });


$(".number1").prettynumber();

});
 </script>




        

        


@stop

