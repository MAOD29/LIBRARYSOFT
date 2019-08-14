<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Library Soft</title>
	
	 <!-- Bootstrap CSS CDN -->
    

    <!-- Font Awesome JS -->
   

    <script src="/js/font.js"></script>
    <script src="/js/font2.js"></script>
    <link rel="stylesheet" href="/css/bs.css">
    <link rel="stylesheet" href="/css/estilos.css">
    <link rel="stylesheet" href="/css/home.css">
    
    
  
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Libreria soft</h3>
                <strong>LS</strong>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="{{route('index')}}" >
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{route('prestamos.create')}}">
                        <i class="fas fa-calendar-plus"></i>
                        Crear Prestamos
                    </a>
                </li>
                <li>
                    <a href="{{route('prestamos.index')}}">
                        <i class="fas fa-archive"></i>
                        Prestamos
                    </a>
                </li>
                 <li>
                    <a href="{{route('visitas.index')}}">
                        <i class="fas fa-clipboard"></i>
                        Visitas
                    </a>
                </li>
                <li>
                    <a href="{{route('libros.index')}}">
                        <i class="fas fa-book"></i>
                        Libros
                    </a>
                </li>
                <li>
                    <a href="{{route('alumnos.index')}}">
                       <i class="fas fa-users"></i>
                        Alumnos
                    </a>
                </li>
                <li>
                    <a href="{{route('usuarios.index')}}">
                        <i class="fas fa-address-card"></i>
                        Usuarios
                    </a>
                </li>
                <li>
                     <a href="{{route('reportes.index')}}">
                        <i class="fas fa-tasks"></i>
                        Reportes
                    </a>
                </li>




                
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="{{ asset('m1.pdf') }}" class="article">MANUAL USUARIO</a>
                </li>
                
            </ul>
        </nav>


        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info2">
                        <i class="fas fa-align-left"></i>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
					@if (auth()->check())
	                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	                        <ul class="nav navbar-nav ml-auto">
	                            <li class="nav-item active">

	                            	<a class="nav-link" href="/usuarios/{{ auth()->id() }}">
										<i class="fas fa-user-circle"></i>
	                            	Mi cuenta</a>
	                                
	                            </li>
	                            <li class="nav-item active">
	                            	
	                                <a class="nav-link" href="/logout">Cerrar sesion</a>
	                            </li>
	                           
	                        </ul>
	                    </div>
	                 @endif
	                 @if(auth()->guest())
						<a class="nav-link"  href="/login">Login</a>
					@endif
                </div>
            </nav>
	

	<div class="container">
        
	@yield('contenido')
	
	</div>
    <script src="/js/jquery.js" ></script>
    <script src="/js/jq2.js" ></script>
	<script src="/js/jq3.js" ></script>


    @yield('scripts')
    <!-- Popper.JS -->
   

    
	
</body>	
</html>