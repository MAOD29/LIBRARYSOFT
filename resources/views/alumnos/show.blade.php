@extends('layout')

@section('contenido')

<h1>{{$alumno->nombre}}</h1>

<table class="table">
		
		<thead>
			<tr>
				<th>Matricula</th>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Turno</th>
				<th>Grado</th>
				<th>Grupo</th>
				

			</tr> 
		</thead>

		<tbody>
			

			<tr>

				<td>{{ $alumno->matricula }}</td>
				<td>{{ $alumno->name }}</td>
				<td>{{ $alumno->apellidos }}</td>
				<td>{{ $alumno->turno}}</td>
				<td>{{ $alumno->grado }}</td>
				<td>{{ $alumno->grupo }}</td>


				
				
			</tr>
			
		</tbody>
	</table>


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