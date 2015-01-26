
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

        
 
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
            <th>Partida</th>
            <th>Item</th>
            <th>Obra</th>
            <th>Cantidad</th>
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

 


  <td class="td-actions">
                       
                          <a class="blue" href={{'usuarios/'.$partida->id }}>
                            <i class='fa fa-zoom-in bigger-130'></i>
                          </a>


                          <a class="green" href= {{ 'usuarios/editar/'.$partida->id }}>
                            <i class="fa fa-pencil bigger-130"></i>
                          </a>

                          <a class="red" href="#">
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
});
 </script>




        

        


@stop

