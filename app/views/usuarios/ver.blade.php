@extends('layouts.master')
 
@section('sidebar')
     @parent
     Información de usuario
@stop
 
@section('contenido')
        {{ HTML::link('usuarios', 'Volver'); }}
        <h1>
  Usuario {{$usuario->id}}
      
</h1>
        
        {{ $usuario->nombre .' '.$usuario->apellido }}
        
<br />
        {{ $usuario->created_at}}
@stop