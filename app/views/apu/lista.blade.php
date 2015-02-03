
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

 
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr >
            <th>Partida</th>
           
            
            <th>Unidad</th>
            <th>Precio U</th>
            <th>Cantidad</th>
            <th>Rendimiento</th>
            <th>Costo</th>
            <th>Acciones</th>
            
          </tr>
        </thead>
        <tbody>
  @foreach($apus as $apu)

 

           <tr>
           	<td>
        {{ $apu->partida->nombre }}
  </td>
  <td> 
 {{$apu->unidad}}
</td>
 
  <td class="number1">{{$apu->preciou}}</td>

  <td> {{ $apu->cantidad  }} </td>

  <td>
{{ $apu->rend  }}
</td>

   <td>

{{ $apu->costo  }}

  </td>
  <td class="td-actions">
                       
                     


                          <a class="green" href= {{ 'apu/editar/'.$apu->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                          <a class="red bootbox-confirm" data-id={{$apu->id}}>
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
            "sSwfPath": "js/TableTools/swf/copy_csv_xls_pdf.swf"
        }
    } );

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
             $.get("{{ url('cheques/eliminar')}}",
              { id: id },
    
      function(data) {
        
      });
            }
          });
        });


});


 </script>




        

        


@stop

