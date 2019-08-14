@extends('layout')

@section('contenido')

	@if(session()->has('info'))
	<div class="alert alert-success">{{ session('info') }}</div>
	@endif
	<h1>Libros</h1>
	<br>
	<div class="row" >
		  <div class="col-8">
		  	<a href="{{ route('libros.create') }}" class="btn btn-success pull-rigth">Crear Libro</a>
		  	<a href="{{ route('materiasc.index') }}" class="btn btn-success pull-rigth">Crear Materia</a>
		  	 <a href="{{route('grafica')}}"  class="btn btn-info "> Libros x Materias</a>
		  </div>

		  <div class="ml-auto col-4 ">
		  	<form method="GET" action="{{ route('libros.index')}}" autocomplete="off">
			     <p> <label for="search" >
					<input class="form-control" type="text" name="search" placeholder="Ingrese código o titulo" >
					</label>
			      <input class="btn btn-primary" type="submit" value="buscar">
				</p>
    		</form>
		  </div>
	</div>

    <table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Código</th>
				<th>Titulo</th>
				<th>Author</th>
				<th>Editorial</th>
				<th>Año publicación</th>
				<th>Materia</th>
				<th>Acciones</th>
			</tr> 
		</thead>
		<tbody>
			@foreach ($libros as $libro)
			<tr>
				<td>{{ $libro->id }}</td>
				<td>{{ $libro->titulo }}</td>
				<td>{{ $libro->author }}</td>
				<td>{{ $libro->editorial }}</td>
				<td>{{ $libro->year}}</td>
				<td>{{ $libro->materias->pluck('nombre')->implode(' - ') }}</td>
				<td>
					<a class="btn btn-info btn-sm" href="{{ route('libros.edit', $libro->id )}}">Editar</a>
					<form style="display: inline;" method="POST" action="{{ route('libros.destroy',$libro->id) }}">
						{!! csrf_field()  !!}
						{!! method_field('DELETE') !!}
						<button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
					</form> 
				</td>
			</tr>
			@endforeach
			{!! $libros->fragment('hash')->appends(request()->query())->links() !!}
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