@extends('layout')


@section('contenido')


<div class="q">
    
     <a href="{{route('prestamos.index')}}"  class="boton "> <img class="i"src="{{ asset('imagenes/libros.png') }}" alt=""> Prestamos</a>
     <a href="{{route('visitas.index')}}"  class="boton "> <img class="i"src="{{ asset('imagenes/visitas.png') }}" alt=""> Visitas </a>
     <a href="{{route('reportes.index')}}"  class="boton "> <img class="i"src="{{ asset('imagenes/reportes.png') }}" alt=""> Reportes</a>
</div>
<div class="q">
        
        <a href="{{route('usuarios.index')}}"  class="boton ">  <img class="i"src="{{ asset('imagenes/alumnos.png') }}" alt="">Alumnos</a>
        <a href="{{route('libros.index')}}"  class="boton ">  <img class="i"src="{{ asset('imagenes/libros2.png') }}" alt="">Libros</a>
        <a href="{{route('alumnos.index')}}"  class="boton ">  <img class="i"src="{{ asset('imagenes/administrador.png') }}" alt=""> Usuarios</a>
   </div>
@stop