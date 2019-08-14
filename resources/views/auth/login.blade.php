<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>LibrarySoft</title>
    <!-- Font Awesome -->
  
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
     <!-- Estilos de login -->
     
</head>

<body style="background-image:url({{ asset('imagenes/login.jpeg') }});">
   
             <!-- AQUI VAN LAS ICONSO ALV-->
<div class="login-img">
    <img src="{{ asset('imagenes/logo.png') }}" alt="">
</div>

<div class="usuario">
    <img src="{{ asset('imagenes/usuario.png') }}" alt="">
</div>

<div class="candado">
    <img src="{{ asset('imagenes/candado.png') }}" alt="">
</div>

			<!-- AQUI VA EL LOGIN BRODY-->
	<form method="POST" action="/login">
	{!! csrf_field()  !!}
		<div class="login">
				<div class="form-group1">
					<div class="usuarioboton">
						<input type="text" class="form-control" id="inputEmail3" name="email" placeholder="Usuario">
					</div>
				</div>
			
				<div class="form-group2">		
					<div class="botoncontra">
						<input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Contraseña">
					</div>
				</div>	
				<div class="botonentrar">
					<div class="col-sm-10">
						<button type="submit" class="btn" >Entrar</button>
					</div>
				</div>
              </div>  
    </form>

 


 
 
</body>

</html>

