
@extends('layouts.admin')
 


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
              <a href={{ URL::to('proyectos') }}>Proyectos</a>

              <span class="divider">
                <i class="fa fa-angle-right arrow-fa fa"></i>
              </span>
            </li>
            <li>Ver Proyectos</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')




<div class="page-header position-relative">
        <h1>
  Proyectos

</h1>
</div>
       

        @if(isset($mensaje))
        <div class="alert alert-block alert-success">{{$mensaje}}</div>
        @endif
 
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
            <th>Nombre</th>
            <th>Plzao</th>
            <th>Fecha Inicio</th>
            <th>Fecha Termino</th>
            <th>Utilidad</th>
            <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>
  @foreach($proyectos as $proyecto)
           <tr><td>
    {{  $proyecto->nombre }}
      
  </td>
  <td> {{ $proyecto->plazo }}</td>
  <td>
    @if ($proyecto->fechainicio > 0)
    {{ date_format(date_create($proyecto->fechainicio),'d/m/Y')  }}
    @endif
  </td>
  <td>
  @if ($proyecto->fechatermino > 0)
    {{ date_format(date_create($proyecto->fechatermino),'d/m/Y')  }}
    @endif
  </td>

  <td>{{$proyecto->utilidad}} %</td>
  <td class="td-actions">
                       
                        


                          <a class="green" href= {{ 'proyectos/editar/'.$proyecto->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                          <a class="red bootbox-confirm" data-id={{ $proyecto->id }}>
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
            "sSwfPath": "TableTools/swf/copy_csv_xls_pdf.swf"
        }
    } );


$( "#proyectoactive" ).addClass( "active" );



$(".bootbox-confirm").on(ace.click_event, function() {
  var id = $(this).data('id');
var tr = $(this).parents('tr'); 

          bootbox.confirm("Deseas Eliminar el registro "+id, function(result) {
            if(result) {
             // bootbox.alert("You are sure!");
             tr.fadeOut(1000);
             $.get("{{ url('proyectos/eliminar')}}",
              { id: id },
    
      function(data) {
        
      });
            }
          });
        });



});
 </script>



        

        


@stop

