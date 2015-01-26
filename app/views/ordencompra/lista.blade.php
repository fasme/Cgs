
@extends('layouts.master')
 


@section('breadcrumb')
<ul class="breadcrumb">
            <li>
              <i class="icon-home home-icon"></i>
              <a href="#">Home</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>

            <li>
              <a href={{ URL::to('orden') }}>orden</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver orden</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')





        <h1>
  ordenes

</h1>
        {{ HTML::link('orden/nuevo', 'Crear Orden'); }}
 
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
            <th>Numero</th>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Neto</th>
            <th>Total</th>
            <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>



  @foreach($ordenes as $orden)
           <tr>

            <td> {{  $orden->ordencompra_id }}</td>
            <td> {{  date_format(date_create($orden->fecha),'d/m/Y') }}</td>
             <td> {{  $orden->proveedor->nombre }}</td>


             <td class="number1">{{$orden->valorneto}}</td>
             <td class="number1">{{round($orden->valorneto * 1.19)}}</td>

              

 
  <td class="td-actions">
                       
                       


                          <a class="green" href= {{ 'ordencompra/editar/'.$orden->ordencompra_id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                          <a class="red bootbox-confirm" data-id={{ $orden->ordencompra_id }}>
                            <i class="fa fa-trash bigger-130"></i>
                          </a>

                          <a class="red" href={{ 'ordencompra/pdf/'.$orden->ordencompra_id }}>
                            <i class="fa fa-file-pdf-o  bigger-130"></i></a>

                          <a class="green" href={{ 'ordencompra/copiar/'.$orden->ordencompra_id }}>
                            <i class="fa fa-copy bigger-130"></i>

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


$( "#ordencompraactive" ).addClass( "active" );
$(".number1").prettynumber();


$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) {
             // bootbox.alert("You are sure!");
             tr.fadeOut(1000);
             $.get("{{ url('ordencompra/eliminar')}}",
              { id: id },
    
      function(data) {
        
      });
            }
          });
        });


});

 </script>



        

        


@stop

