@extends('layout')


@section('contenido')

	<h1>Datos Alumno</h1>
	<br>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{route('alumnos.index')}}">Alumnos</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Crear Alumno</li>
	  </ol>
	</nav>

	<form method="POST" action="{{ route('alumnos.store' )}}" autocomplete="off">
			
			
			@include('alumnos.form',['alumno'=> new App\Alumno])

			
			<div class="container">
				<input class="btn btn-success btn-lg btn-block" type="submit" value="Guardar">
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