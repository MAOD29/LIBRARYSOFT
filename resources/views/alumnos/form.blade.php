{!! csrf_field()  !!}

 <div class="row">
	  <div class="col-4">
	  	<label for="matricula">Matricula</label>
	    <input class="form-control" type="text" name="matricula" value="{{$alumno->matricula or old('matricula')}}" placeholder="Ingrese matricula del alumno">
		{!! $errors->first('matricula', '<span class=error>:message</span>') !!}
	  </div>

	  <div class="col-4">
	  	<label for="matricula">Nombre</label>
	  	<input class="form-control" type="text" name="name" value="{{$alumno->name or old('name')}}" placeholder="Ingrese nombre del alumno">
		{!! $errors->first('name', '<span class=error>:message</span>') !!}
	  </div>

	  <div class="col-4">
	  	<label for="apellidos" >Apellidos</label>
		<input class="form-control" type="text" name="apellidos" value="{{$alumno->apellidos or old('apellidos')}}" placeholder="Ingrese apellidos ">
		{!! $errors->first('apellidos', '<span class=error>:message</span>') !!}
		
	  </div>
</div>

<br>

<div class="row">
	<div class="col-4">
		<label class="my-1 mr-2" for="inlineFormCustomSelectPrefa"> Elegir turno </label>
		  <select class="custom-select " id="inlineFormCustomSelectPrefa " name="turno">
      			<option 
      				@if( $alumno->turno == 'Matutino' )
						selected="selected" 
					@endif
      			 	value=" Matutino" > Matutino 
      			</option>
				<option 
      				@if( $alumno->turno == 'Despertino' )
						selected="selected" 
					@endif
      			 	value=" Despertino" > Despertino 
      			</option>	   	
			    {!! $errors->first('name', '<span class=error>:message</span>') !!}
		  </select>
	</div>

	<div class="col-4">
		<label class="my-1 mr-2" for="inlineFormCustomSelectPref"> Elegir grado </label>
		  <select class="custom-select " id="inlineFormCustomSelectPref " name="grado">
			@for ($i = 1; $i < 7; $i++)
          		<option 
          			@if( $alumno->grado == $i )
						selected="selected" 
					@endif	
          			 	value="{{$i}}">
          				{{$i}} 
          			</option>
			   	@endfor
			    {!! $errors->first('name', '<span class=error>:message</span>') !!}
		  </select>
	</div>
	<div class="col-4">
		<label for="grupo" >Grupo</label>
		<input class="form-control" type="text" name="grupo" value="{{$alumno->grupo or old('grupo')}}" placeholder="Ingrese grupo del alumno">
		{!! $errors->first('grupo', '<span class=error>:message</span>') !!}
	</div>
<div>

	<br><br><br>
