@extends('layout')

@section('contenido')

<p>Prestamos actual </p>


	    <table class="table">
			
			<thead>
				<tr>
					<th>Folio de prestamo</th>
					<th>Código de libro</th>
					<th>matricula</th>
					
					<th>Nombre</th>
					
					<th>Turno</th>
					<th>Grado</th>
					<th>Grupo</th>
					
					<th>Fecha de prestamo</th>
					<th>Fecha de entrega</th>
					<th>Acción</th>
					
					

				</tr> 
			</thead>

			<tbody>
				@foreach ($prestamos as $prestamo)

				
				
					

						<tr>
							
							<td>{{ $prestamo->id }}</td>
							<td>{{ $prestamo->id_libro }}</td>
							<td>{{ $prestamo->matricula }}</td>
							<td>{{ $prestamo->nombre }} {{ $prestamo->apellidos }}</td>
							<td>{{ $prestamo->turno }}</td>
							<td>{{ $prestamo->grado}}</td>
							<td>{{ $prestamo->grupo }}</td>
							<td>{{ $prestamo->fecha_prestamo->toDateString() }}</td>
							<td>{{ $prestamo->fecha_entrega->toDateString() }}</td>
							
							<td>
								
								
								<form style="display: inline;" method="POST" action="{{ route('prestamos.destroy',$prestamo->id) }}">

									{!! csrf_field()  !!}
									{!! method_field('DELETE') !!}

									<button class="btn btn-danger btn-sm" type="submit">Eliminar Prestamo</button>
								</form> 
							</td>
							
						</tr>
					

				@endforeach
			</tbody>
		</table>

		<form method="GET" action="{{ route('crprestamo') }}">

			@foreach ($prestamos as $prestamo)
	
				<input type="hidden" name="id_libro" value="{{$prestamo->id_libro}}" />

				<input type="hidden" name="matricula" value="{{$prestamo->matricula}}" />

			@endforeach	
			
				<button class="btn btn-danger btn-sm" type="submit">Descar PDF</button>
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

		
