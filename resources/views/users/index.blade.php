@extends('layout')

@section('contenido')
	
	@if(session()->has('info'))
		<div class="alert alert-success">{{ session('info') }}</div>
	@endif
	
    <h1>Usuarios</h1>    
    <br>
	<a href="{{ route('usuarios.create') }}" class="btn btn-success pull-rigth">Crear usuario</a>
	<br><br><br>
    <table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				 <th>Email</th>
				 <th>Role</th>
				 <th>Acciones</th>
			</tr> 
		</thead>

		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
						<td>
							<!-- usando los metodos de collection puedo entrar a las caracteristicas del array
								y con el uso de eloquen automaticamente trae datos de la BD  -->
							{{ $user->roles->pluck('display_name')->implode(' - ') }}
					<!-- esta es la opcion de mostrar los roles pero con un for recorriendo el array
							@foreach($user->roles as $role)
							{{$role->display_name }}
							@endforeach
						-->
						</td>
					<td>
						<a class="btn btn-info btn.xs" href="{{ route('usuarios.edit', $user->id )}}">Editar</a>
						
						@if ($user->roles->pluck('display_name')->implode(' - ') == 'Moderador')
						<form style="display: inline;" method="POST" action="{{ route('usuarios.destroy',$user->id) }}">
							{!! csrf_field()  !!}
							{!! method_field('DELETE') !!}
							<button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
						</form> 
						@endif
					</td>
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