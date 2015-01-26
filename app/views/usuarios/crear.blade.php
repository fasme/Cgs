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
              <a href={{ URL::to('usuarios') }}>Usuarios</a>

              <span class="divider">
                <i class="icon-angle-right arrow-icon"></i>
              </span>
            </li>
            <li>Ver Usuarios</li>
          </ul><!--.breadcrumb-->

          @stop
 
@section('contenido')
        {{ HTML::link('usuarios', 'volver'); }}
        <h1>
  Crear Usuario
      
    
  
</h1>
        {{ Form::open(array('url' => 'usuarios/crear')) }}
            {{Form::label('nombre', 'Nombre')}}
            {{Form::text('nombre', '')}}
            {{Form::label('apellido', 'Apellido')}}
            {{Form::text('apellido', '')}}
            {{Form::submit('Guardar')}}
        {{ Form::close() }}
@stop