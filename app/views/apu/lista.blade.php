
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

 <div class="row-fluid">


                <div class="table-header">
                  Resultados
                </div>
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr >
            <th>Orden</th>
            <th>Partida</th>
            <th>Obra</th>
            <th>P unitario</th>
          
            <th>Acciones</th>
            
          </tr>
        </thead>

        <tfoot>
            <tr>
              <th></th>
                <th></th>
                <th></th>
               <th class="number1"></th>
                <th></th>
                
              
            </tr>
        </tfoot>


        <tbody>
  @foreach($partidas as $partida)

 

           <tr>
            <td>{{ $partida->orden }} </td>
  <td>{{ $partida->nombre }} <small class="text-success">{{$partida->partidacategoria->nombre}}</small> </td>
  <td>{{ $partida->obra->nombre }} </td>
  <?php  $suma =0; ?>
  @foreach($partida->apu as $apu)
 <?php $suma += round($apu->cantidad*$apu->preciou*(1/$partida->cantidad)); 
    ?>
    @endforeach
  <td class="number1">{{$suma}}</td>


  <td class="td-actions">
                       
                     


                          <a class="green" href= {{ 'apu/editar/'.$partida->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>
<!--
                          <a class="red bootbox-confirm" data-id=>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>
     -->
                      </td>
</tr>
          @endforeach
        </tbody>
  </table>
</div>

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
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
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

