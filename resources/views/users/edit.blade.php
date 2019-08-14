@extends('layout')


@section('contenido')

	<h1>editar usuario</h1>

	@if(session()->has('info'))
		<div class="alert alert-success">{{ session('info') }}</div>
		
	@endif

	<form method="POST" action="{{ route('usuarios.update', $user->id) }}" autocomplete="off">
			{!! method_field('PUT') !!}
			@include('users.form')
			<input class="btn btn-success" type="submit" value="Enviar">


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