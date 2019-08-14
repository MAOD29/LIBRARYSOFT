@extends('layout')


@section('contenido')

<h1>IMPORTAR ARCHIVOS</h1>

<nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('reportes.index')}}">Reportes</a></li>
        <li class="breadcrumb-item active" aria-current="page">Importar Documentos</li>
      </ol>
    </nav>

<br><br>

<div class="row" >
    <div class="col-6">


    <form method="post" action="{{route('ialumno')}}" enctype="multipart/form-data">

        {{csrf_field()}}
        <label for="excel">IMPORTAR ALUMNOS
            <br><br>
        <input type="file" class="btn-info" name="excel">
        <br><br>
        <input type="submit" value="Enviar" class="btn-success" style="padding: 10px 20px;">
        </label>
    </form>

    </div>


<br>
<br><br>
<div class="col-6">

<form method="post" action="{{route('ilibros')}}" enctype="multipart/form-data">

        {{csrf_field()}}
        <label for="excel">IMPORTAR LIBROS
            <br><br>
        <input type="file" class="btn-info" name="excel">
        <br><br>
        <input type="submit" value="Enviar" class="btn-success" style="padding: 10px 20px;">
    </label>
    </form>
</div>
</div>

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