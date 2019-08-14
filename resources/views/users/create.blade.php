@extends('layout')


@section('contenido')

	<h1>Crear usuarios</h1>

	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{route('usuarios.index')}}">Usuarios</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Crear Usuario</li>
	  </ol>
	</nav>

	<form method="POST" action="{{ route('usuarios.store' )}}" autocomplete="off" >
		@include('users.form',['user'=> new App\User])
		<input class="btn btn-success" type="submit" value="Guardar">
	</form>

@stop
@section('scripts')
	<script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    @stop 