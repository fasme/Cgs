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
 
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr >
            <th>Proyecto</th>
            <th>Categoria</th>
            <th>Nombre</th>
            <th>Unidad</th>
            <th>Cantidad</th>
            <th>Precio</th>
         <th>Total</th>
            <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>
  @foreach($gg as $gastos)
  <tr>
    <td>{{ $gastos->proyecto->nombre }}</td>
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


  <script type="text/javascript">
 $(document).ready(function() {

$('#example').DataTable( {
"iDisplayLength": 100,
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "TableTools/swf/copy_csv_xls_pdf.swf"
        }
    } );


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

