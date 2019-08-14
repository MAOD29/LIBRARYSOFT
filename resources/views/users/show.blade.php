@extends('layout')

@section('contenido')

<h1>{{$user->name}}</h1>

<table class="table">
	 
	<tr>
		<td>Nombre</td>
		<td>{{$user->name}}</td>

	</tr>
	<tr>
		<td>Email</td>
		<td>{{$user->email}}</td>
		
	</tr>
	<tr>
		<td>Roles</td>
		<td>
			@foreach($user->roles as $role)
			{{$role->display_name}}
			@endforeach
		</td>
		
	</tr>
</table>
<!--
/*
@can('edit',  $user)
	<a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-info">Editar</a>
@endcan	


@can('destroy',  $user)
	<a class="btn btn-info btn.xs" href="{{ route('usuarios.edit', $user->id )}}">Editar</a>
					
					<form style="display: inline;" method="POST" action="{{ route('usuarios.destroy',$user->id) }}">

						{!! csrf_field()  !!}
						{!! method_field('DELETE') !!}

						<button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
					</form> 
@endcan	
*/
-->
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