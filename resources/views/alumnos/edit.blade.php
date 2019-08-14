@extends('layout')


@section('contenido')

	<h1>Editar Alumno</h1>

	@if(session()->has('info'))
		<div class="alert alert-success">{{ session('info') }}</div>
	@endif

	<form method="POST" action="{{ route('alumnos.update', $alumno->id) }}" autocomplete="off">
			{!! method_field('PUT') !!}
			@include('alumnos.form')	

			<div class="container">
				<input type="submit" class="btn btn-primary btn-block"  value="Enviar">
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