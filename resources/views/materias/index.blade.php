@extends('layout')


@section('contenido')
    
    <h1>Crear Materias</h1>

    <form method="POST" action="{{ route('materiasc.store' )}}" autocomplete="off" >
		{!! csrf_field()  !!}
		<div class="form-group row">
			<div class="col-4">
				<label for="nombre"> Nombre de materia</label>
					<input class="form-control" type="text" name="nombre" required value="{{old('nombre')}}" placeholder="Ingrese nombre completo">
					{!! $errors->first('nombre', '<span class=error>:message</span>') !!}
			</div>
		</div>
		<input class="btn btn-success" type="submit" value="Guardar">
	</form>



@stop