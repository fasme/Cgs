@extends('layouts.master')

@section('contenido')
      <h1>Editar Usuario</h1>
            <!--si el formulario contiene errores de validación-->
            @if($errors->has())
                <div class="alert-box alert">          
                    <!--recorremos los errores en un loop y los mostramos-->
                    @foreach ($errors->all('<p>:message</p>') as $message)
                        {{ $message }}
                    @endforeach
                    
                </div>
            @endif
 
            <table>
                {{ Form::open(array('url' => 'usuarios/editar/'.$usuario->id)) }}
                <tr>
                    <td>
                        {{ Form::label('Nombre', 'Título') }}
                    </td>
                    <td>
                        {{ Form::text('nombre', Input::old('nombre') ? Input::old('nombre') : $usuario->nombre) }}
                    </td>
                </tr>
 
                <tr>
                    <td>
                        {{ Form::label('apellido', 'Post') }}
                    </td>
                    <td>
                         {{ Form::text('apellido', Input::old('apellido') ? Input::old('apellido') : $usuario->apellido) }}
                    </td>
                </tr>


                 <tr>
                    <td>
                        {{ Form::label('password', 'Post') }}
                    </td>
                    <td>
                         {{ Form::text('password', Input::old('password') ? Input::old('password') : $usuario->password) }}
                    </td>
                </tr>
 
                <tr>
                    <td>
 
                    </td>
                    <td>
                         {{ Form::submit('Editar') }}
                    </td>
                </tr>              
                {{ Form::close() }}
            </table>    
            

@stop