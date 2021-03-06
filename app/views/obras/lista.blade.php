
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
            <li>Ver Obras</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')





        <h1>
  Obras

</h1>
        {{ HTML::link('obras/nuevo', 'Crear Obra'); }}
        
 
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
            <th>Proyecto</th>
            <th>Obra</th>
            <th>Acciones</th>
  
            
          </tr>
        </thead>
        <tbody>


  @foreach($obras as $obra)
           <tr>

             <td> {{ $obra->proyecto->nombre }}</td>
            <td>
    {{  $obra->nombre }}
      
  </td>

 


  <td class="td-actions">
                       
               

                          <a class="green" href= {{ 'obras/editar/'.$obra->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                          <a class="red bootbox-confirm" data-id={{ $obra->id }}>
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


$( "#obraactive" ).addClass( "active" );
$( "#proyectoactive" ).addClass( "active" );


$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) {
             // bootbox.alert("You are sure!");
             tr.fadeOut(1000);
             $.get("{{ url('obras/eliminar')}}",
              { id: id },
    
      function(data) {
        
      });
            }
          });
        });



});
 </script>




        

        


@stop

