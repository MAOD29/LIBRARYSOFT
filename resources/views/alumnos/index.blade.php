@extends('layout')

@section('contenido')
	


	<h1>Listado de alumnos</h1>
	<br>
	<div class="row" >
		  <div class="col-8">
		  	<a href="{{ route('alumnos.create') }}" class="btn btn-success pull-rigth ">Crear alumno</a>
		  </div>

		  <div class="ml-auto col-4 ">
		  	<form method="GET" action="{{ route('alumnos.index')}}" autocomplete="off"> 
		      <label for="search" >
				<input class="form-control" type="text" name="search" placeholder="Ingrese Matricula o Nombre">
			  </label>
	      		<input class="btn btn-primary" type="submit" value="Buscar">
	 		</form>
		  </div>
	</div>
	<br>
    <table class="table  table-bordered table-striped">
		<thead>
			<tr>
				<th>Matricula</th>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Turno</th>
				<th>Grado</th>
				<th>Grupo</th>
				<th>Acciones</th>
			</tr> 
		</thead>

		<tbody>
			@foreach ($alumnos as $alumno)
				<tr>
					<td>{{ $alumno->matricula }}</td>
					<td>{{ $alumno->name }}</td>
					<td>{{ $alumno->apellidos }}</td>
					<td>{{ $alumno->turno}}</td>
					<td>{{ $alumno->grado }}</td>
					<td>{{ $alumno->grupo }}</td>
					<td>
						 <!--<a class="btn btn-info btn-sm" href="{{ route('alumnos.show', $alumno->id )}}">ver</a> -->
						<a class="btn btn-info btn-sm" href="{{ route('alumnos.edit', $alumno->id )}}">Editar</a>
						<form style="display: inline;" method="POST" action="{{ route('alumnos.destroy',$alumno->id) }}">
							{!! csrf_field()  !!}
							{!! method_field('DELETE') !!}
							<button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
						</form> 
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@if(session()->has('info'))
	<div class="alert alert-success">{{ session('info') }}</div>
@endif

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