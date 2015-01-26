
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
              <a href={{ URL::to('usuarios') }}>Usuarios</a>

              <span class="divider">
                <i class="fa fa-angle-right arrow-fa fa"></i>
              </span>
            </li>
            <li>Ver Usuarios</li>
          </ul><!--.breadcrumb-->

          @stop

@section('contenido')





        <h1>
  Usuarios

</h1>
        {{ HTML::link('usuarios/nuevo', 'Crear Usuario'); }}
 
<table id="example" class="table table-striped table-bordered table-hover">
  <thead>
          <tr>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Stock</th>
            <th>Precio Commpra</th>
            <th>Precio Venta</th>
            
          </tr>
        </thead>
        <tbody>
  @foreach($usuarios as $usuario)
           <tr><td>
    {{ HTML::link( 'usuarios/'.$usuario->id , $usuario->nombre.' '.$usuario->apellido ) }}
      
  </td>
  <td> {{ $usuario->created_at }}</td>
  <td></td>
  <td></td>
  <td class="td-actions">
                       
                          <a class="blue" href={{'usuarios/'.$usuario->id }}>
                            <i class='fa fa-zoom-in bigger-130'></i>
                          </a>


                          <a class="green" href= {{ 'usuarios/editar/'.$usuario->id }}>
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
            "sSwfPath": "TableTools/swf/copy_csv_xls_pdf.swf"
        }
    } );
});
 </script>




        

        


@stop

