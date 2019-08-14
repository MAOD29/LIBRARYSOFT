@extends('layout')


@section('contenido')
@if(session()->has('info'))
		<div class="alert alert-danger">
		<span class="close" data-dismiss="alert">&times;</span>
		<strong>Error!</strong> {{ session('info')  }}
	</div>
	@endif
	@if(session()->has('info2'))
		<div class="alert alert-success">
		<span class="close" data-dismiss="alert">&times;</span>
		<strong>{{ session('info2')  }}</strong> 
	</div>
	@endif


	<br>
	<div class="row" >
		  <div class="col-5">
		  	<h1>Visitas</h1>
		  </div>

		  <div class="ml-auto col-7 ">
		  	<form method="POST" action="{{ route('visitas.store')}}" autocomplete="off">
		  		{!! csrf_field()  !!}
			     <p><label for="titulo" >
						<input class="form-control" type="text" name="matricula" placeholder="ingrese matricula">
						{!! $errors->first('matricula', '<span class=error>:message</span>') !!}
					</label>
					<label for="author" >
						<input class="form-control" type="text" name="tema" placeholder="ingrese tema a investigar">
						{!! $errors->first('tema', '<span class=error>:message</span>') !!}
					</label>
			      <input class="btn btn-success" type="submit" value="Registrar">
				</p>
    		</form>
		  </div>
	</div>

	<br>

	<table  class="table">

		<thead>
			<tr>
			<th>Matricula</th>
			<th>Nombre</th>
			<th>Grado y grupo</th>
			<th>Tema a investigar</th>
			<th>Entrada</th>
			<th>Salida</th>
			<th>Accion</th>
			</tr>
		</thead>
		<tbody>
			@foreach($visitas as $visita)

			<tr>
			
				<td>{{ $visita->matricula }}</td>
				<td>{{ $visita->nombre }}</td>
				<td>{{ $visita->grado_grupo }}</td>
				<td>{{ $visita->tema  }}</td>
				<td>{{ $visita->entrada->format('d/m/Y H:i') }}</td>
				@if($visita->estado=='si')
					<td>{{ $visita->salida }}</td>
					<td>
					<form style="display: inline;" method="POST" action="{{ route('visitas.destroy',$visita->id) }}">
						{!! csrf_field()  !!}
						{!! method_field('DELETE') !!}
						<button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
					</form>
					 
					</td>
				@else
					<td>Sin finalizar</td>
					<td>
						<form style="display: inline;" method="POST" action="{{ route('visitas.update',$visita->id) }}">
						{!! csrf_field()  !!}
						{!! method_field('PUT') !!}
						<button class="btn btn-danger btn-sm" type="submit">Terminar visita</button>
						</form> 
					
					</td>
				@endif	
				

			</tr>	
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