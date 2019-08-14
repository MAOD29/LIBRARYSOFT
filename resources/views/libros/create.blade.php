@extends('layout')


@section('contenido')

	<h1>Crear Libro</h1>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{route('libros.index')}}">Libros</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Crear Libro</li>
	  </ol>
	</nav>

	<form method="POST" action="{{ route('libros.store' )}}" autocomplete="off">
			@include('libros.form',['libro'=> new App\Libro])
			<div class="container">
				<input class="btn btn-success" type="submit" value="Guardar">
			</div>
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