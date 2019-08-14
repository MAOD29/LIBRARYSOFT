@extends('layout')


@section('contenido')

	<h1>Editar Libro</h1>

	@if(session()->has('info'))
		<div class="alert alert-success">{{ session('info') }}</div>
	@endif

	<form method="POST" action="{{ route('libros.update', $libro->id) }}" autocomplete="off">
			{!! method_field('PUT') !!}
			
			@include('libros.form')

			<input class="btn btn-primary" type="submit" value="Enviar">


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