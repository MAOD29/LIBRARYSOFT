@extends('layout')


@section('contenido')

<h1>Crear Visita</h1>
<br><br>
<form method="POST" action="{{ route('visitas.store' )}}" autocomplete="off">

	{!! csrf_field()  !!} 
	 <div class="row">
		  <div class="col-4">
			<label for="titulo" >
			Matricula
			<input class="form-control" type="text" name="matricula">
			{!! $errors->first('matricula', '<span class=error>:message</span>') !!}
			</label>
		  </div>

		  <div class="col-4">
			<label for="author" >
			Tema a investigar
			<input class="form-control" type="text" name="tema" >
			{!! $errors->first('tema', '<span class=error>:message</span>') !!}
			</label>
		  </div>
	</div>
	<br><br>
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