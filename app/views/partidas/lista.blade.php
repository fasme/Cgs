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
            <th>Acciones</th>
  
            
          </tr>
        </thead>
        <tbody>


  @foreach($partidas as $partida)
           <tr>

             <td> {{ $partida->nombre}}</td>
            <td> {{  $partida->item }} </td>
             <td> {{  $partida->obra->nombre }} </td>
              <td> {{  $partida->cantidad }} </td>
              <td> {{  $partida->unidad }} </td>
<td> {{  $partida->orden }} </td>
 


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


$('#example').DataTable( {
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "js/TableTools/swf/copy_csv_xls_pdf.swf"
        }
    } );


$( "#proyectoactive" ).addClass( "active" );
$( "#partidasactive" ).addClass( "active" );




$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) { // si se seleccion OK
              
           
             
             $.get("{{ url('partidas/eliminar')}}",
              { id: id },

              function(data,status){ tr.fadeOut(1000); }
).fail(function(data){bootbox.alert("No se puede eliminar un registro padre: una restricción de clave externa falla");});

     
            }
           
          });
        });





}); // fin ready
 </script>




        

        


@stop

