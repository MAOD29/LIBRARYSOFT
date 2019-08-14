{!! csrf_field()  !!}
<br>
 <div class="row">
	  <div class="col-4">
		<label for="titulo" >Titulo</label>
		<input class="form-control" type="text" name="titulo" required value="{{$libro->titulo or old('titulo')}}">
		{!! $errors->first('titulo', '<span class=error>:message</span>') !!}
	  </div>

	  <div class="col-4">
		<label for="author" >Author</label>
		<input class="form-control" type="text" name="author" required value="{{$libro->author or old('author')}}">
		{!! $errors->first('author', '<span class=error>:message</span>') !!}
		
	  </div>

	  <div class="col-4">
	  	<label for="editorial" >Editorial</label>
		<input class="form-control" type="text" name="editorial" required value="{{$libro->editorial or old('editorial')}}">
		{!! $errors->first('editorial', '<span class=error>:message</span>') !!}

	  </div>
</div>
<br><br>
 <div class="row">
	  <div class="col-4">
		<label for="año" >Año de publicación</label>
			<input class="form-control" type="text" name="year" required value="{{$libro->year or old('year')}}">
			{!! $errors->first('year', '<span class=error>:message</span>') !!}
	  </div>

	  <div class="col-4">
		<label class="my-1 mr-2" for="inlineFormCustomSelectPref">Elegir Materia</label>
			  <select class="custom-select " id="inlineFormCustomSelectPref " name="materias[] ">
				    @foreach ($materias as $id => $name)
	          			<option 
	          					@if(  $libro->materias->pluck('id')->contains($id))
									selected="selected" 
								@endif	
	          			 		value="{{ $id }}" >
	          					{{$name}} 
	          			</option>
				    @endforeach
				    {!! $errors->first('materias', '<span class=error>:message</span>') !!}
			  </select>
	
	  </div>
	  <div class="col-4">
		<label class="my-1 mr-2" for="inlineFormCustomSelectPrefa"> Elegir estado </label>
		  <select class="custom-select " id="inlineFormCustomSelectPrefa " name="estado">
      			<option 
      				@if( $libro->estado == 'Mulitado' )
						selected="selected" 
					@endif
      			 	value=" Mutilado" > Mutilado 
      			</option>
				<option 
      				@if( $libro->estado == 'Maltratado' )
						selected="selected" 
					@endif
      			 	value=" Maltratado" > Maltratado
      			</option>	
      			<option 
      				@if( $libro->estado == 'Restaurado' )
						selected="selected" 
					@endif
      			 	value=" Restaurado" > Restaurado
      			</option>	
      			<option 
      				@if( $libro->estado == 'Procesado' )
						selected="selected" 
					@endif
      			 	value=" Correcto" > Correcto
      			</option>	
      			  	
			    {!! $errors->first('name', '<span class=error>:message</span>') !!}
		  </select>
	</div>
</div>
<br><br>
		



