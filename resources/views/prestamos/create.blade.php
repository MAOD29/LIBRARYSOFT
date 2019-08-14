@extends('layout')

@section('contenido')
	
	@if(session()->has('info'))
		<div class="alert alert-danger">
		<span class="close" data-dismiss="alert">&times;</span>
		<strong>Error!</strong> {{ session('info')  }}
	</div>
	@endif

	<div class="row" >
		<div class="col-8">
			<h1>Crear Prestamos</h1>


		</div>
		<div class="col-4">
			<form method="GET" action="{{ route('prestamos.create')}}" autocomplete="off">
		     <p> <label for="search" >
				Alumno
				<input class="form-control" type="text" name="search" placeholder="Ingrese matricula">
				</label>
			
		      <input class="btn btn-primary" type="submit" value="buscar">
			</p>
		    </form>
		</div>
	</div>

    

    @foreach ($prestamos as $prestamo)
    Datos del alumno
    <hr>
	    <form method="POST" action="{{ route('prestamos.store') }}"autocomplete="off">
			{!! csrf_field()  !!}


			 <div class="row">
				  <div class="col-3">
				  <label for="matricula">Matricula
	    	    		<input class="form-control " readonly="readonly" type="text" name="matricula" value="{{ $prestamo->matricula}}" >
	    	    	</label>
				  </div>
				  <div class="col-3">
				  	<label for="nombre">Nombre
	    				<input class="form-control" readonly="readonly" type="text" name="nombre" value="{{ $prestamo->name}}">
	    			</label>
				  </div> 
				  <div class="col-3">
				  	<label >Apellidos
			    		<input class="form-control" readonly="readonly" type="text" name="apellidos" value="{{ $prestamo->apellidos}}">
			    	</label>
				  </div> 
				  <div class="col-3">
				  		<label >Turno
				    		<input  class="form-control" readonly="readonly" type="text" name="turno" value="{{ $prestamo->turno}}">
				    	</label>
				  </div> 
				  <div class="col-3">
				  	<label >Grado
			    		<input  class="form-control" readonly="readonly" type="text" name="grado" value="{{ $prestamo->grado}} ">
			    	</label>
				  </div> 
				  <div class="col-3">
				  	<label >Grupo
	    				<input class="form-control" readonly="readonly" type="text" name="grupo" value="{{ $prestamo->grupo }}">
	    			</label>
				  </div>  
					<div class="col-3">
					  	<label >			Prestamos en proceso:
							{{ $cuenta }}
						</label>
				    	<p><a class="btn btn-info btn-sm" href="{{ route('prestamos.show',$prestamo->matricula  )}}"disabled>ver</a></p>
					  </div> 
			</div>

			<hr >
			 Datos de prestamo
			 <hr>
			@if($cuenta >=2)
				<p>No se permiten mas prestamos</p>
           @else
		 <div class="row">
				<div class="col-3">	
				<label >
		    		Código del libro
		    		<input class="form-control" type="text" name="id_libro">
		    	</label>
		    	</div>
		    	<div class="col-3">	
		    	<label >
		    		Fecha de prestamo
		    		<input class="form-control" type="text"  readonly="readonly" value="{{ $today }}">
		    	</label>
		    	</div>
		    	<div class="col-3">	
		    	<label >
		    		Fecha de entrega
		    		<input class="form-control" type="text" readonly="readonly" value="{{ $today->addDay(2) }}" >
		    	</label>
				</div>
				<div class="col-3">	
					<p></p>
		    	<input class="btn btn-success" type="submit" value="prestar">
				</div>
           @endif
	    </form>	
	@endforeach
    <hr>





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