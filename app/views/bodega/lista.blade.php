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
 Bodega

</h1>
        {{ HTML::link('bodega/nuevo', 'Crear bodega'); }}
 
 <div class="row-fluid">


                <div class="table-header">
                  Resultados
                </div>
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr >
          
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Ubicacion</th>
            <th>estado</th>
            <th>ultima revision</th>
         <th>observacion</th>
            <th>Acciones</th>
            
          </tr>
        </thead>


        <tfoot>
            <tr>
             
                <th></th>
                <th class=""></th>
                <th class=""></th>
                <th class=""></th>
                <th ></th>
                <th ></th>
            <th class=""></th>
              
            </tr>
        </tfoot>



        <tbody>
  @foreach($bodegas as $bodega)
  <tr>
 
    <td>{{ $bodega->codigo }}</td>
  <td> {{ $bodega->nombre }}</td>
  <td>{{ $bodega->ubicacion }}</td>
  <td>

  @if ( $bodega->estado === "1")
<span class="label label-success arrowed-in arrowed-in-right">
   En uso
   </span>

@elseif ( $bodega->estado === "2")
<span class="label label-info">
   En Mantencion
   </span>

@elseif ( $bodega->estado === "3")
<span class="label label-warning">
   En Reparacion
   </span>

   @elseif ( $bodega->estado === "4")
<span class="label label-important">
   Malo
   </span>

   @elseif ( $bodega->estado === "5")
<span class="label label-inverse arrowed">
   Obsoleto
   </span>


@endif

</td>
  <td >{{ date_format(date_create($bodega->ultimarevision),'d/m/Y')}}</td>
<td >{{$bodega->observacion}}</td>
  <td class="td-actions">
                       
                          <a class="blue" href={{'bodega/'.$bodega->id }}>
                            <i class='fa fa-zoom-in bigger-130'></i>
                          </a>


                          <a class="green" href= {{ 'bodega/editar/'.$bodega->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                          <a class="red bootbox-confirm" data-id={{ $bodega->id }}>
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
$("#example tfoot th").eq(2).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');
$("#example tfoot th").eq(3).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');
$("#example tfoot th").eq(4).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');
$("#example tfoot th").eq(5).html('<input type="text" size="1" placeholder="Buscar" style="width:50px" />');

var table = $('#example').DataTable( {
"iDisplayLength": -1,
 "columnDefs": [ {
      "targets": 4,
      "type": 'eu_date'
    }
     ],
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "js/TableTools/swf/copy_csv_xls_pdf.swf"
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


$( "#bodegaactive" ).addClass( "active" );




$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) {
             // bootbox.alert("You are sure!");
             tr.fadeOut(1000);
             $.get("{{ url('bodega/eliminar')}}",
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

