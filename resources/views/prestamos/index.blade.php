@extends('layout')

@section('contenido')
	
	@if(session()->has('info'))
		<div class="alert alert-danger">
		<span class="close" data-dismiss="alert">&times;</span>
		{{ session('info')  }}
	</div>
	@endif
	@if(session()->has('info2'))
		<div class="alert alert-success">
		<span class="close" data-dismiss="alert">&times;</span>
		<strong>Correcto!</strong> {{ session('info2')  }}
	</div>
	@endif

	<h1>Prestamos</h1>

	<div class="row" >
		<div class="col-10">
			<form method="GET" action="{{ route('prestamos.index')}}" autocomplete="off" >
		     <p> <label for="search" >
				Alumno
				<input class="form-control" type="text" name="search"  placeholder="Ingrese matricula">
				</label>
		      <input class="btn btn-primary" type="submit" value="buscar">
			</p>
		    </form>
		</div>
		@empty($manda)@else
			<div class="ml-auto col-2 "><p>
				<form method="GET" action="{{ route('rprestamo') }}">
				<input type="hidden" name="search" value="{{ $manda }}" />
				<button class="btn btn-danger " type="submit">Descar PDF</>
				</form> 
			</div>	
		@endempty
		
		</p>
	
		  
	</div>


	    <table class="table table-bordered table-striped">
			
			<thead>
				<tr>
					<th>Folio</th>
					<th>Código de libro</th>
					<th>matricula</th>
					<th>Nombre</th>
					<th>Turno</th>
					<th>Grado</th>
					<th>Grupo</th>					
					<th>Fecha de prestamo</th>
					<th>Fecha de entrega</th>
					<th>Multa</th>
					<th>Acción</th>
				</tr> 
			</thead>

			<tbody>
				@foreach ($prestamos as $prestamo)
					@if($prestamo->estado == 'no')
						<tr>
							<td>{{ $prestamo->id }}</td>
							<td>{{ $prestamo->id_libro }}</td>
							<td>{{ $prestamo->matricula }}</td>
							<td>{{ $prestamo->nombre }} {{ $prestamo->apellidos }}</td>
							<td>{{ $prestamo->turno }}</td>
							<td>{{ $prestamo->grado}}</td>
							<td>{{ $prestamo->grupo }}</td>
							<td>{{ $prestamo->fecha_prestamo->format('d/m/Y') }}</td>
							<td>{{ $prestamo->fecha_entrega->diffForHumans() }}</td>
							<td>{{ $prestamo->multa }}</td>
							<td>
								<form style="display: inline;" method="POST" action="{{ route('prestamos.update',$prestamo->id) }}">
									{!! csrf_field()  !!}
									{!! method_field('PUT') !!}
									<input type="hidden" name="multa" value="{{ $prestamo->multa }}">
									<button class="btn btn-danger btn-sm" type="submit">Finalizar Prestamo</button>
								</form> 
							</td>
						</tr>
					@endif	
				@endforeach
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