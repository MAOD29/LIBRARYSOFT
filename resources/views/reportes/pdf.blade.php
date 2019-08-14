<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>reporte</title>
    <link rel="stylesheet" href="/css/pdf.css">
    

</head>
<body>
    <div class="logo">
        <img src="/css/sasd" alt="">
    </div>
    <br><br>
    <div class="text">
        <p> <strong> COLEGIO DE BACHILLERES <br>
        PLANTEL 06  </strong></p>
    </div>
    <div class="text2">
        <p> <strong>  <br> BIBLIOTECA
    PRESTAMOS VIGENTES </strong></p>
    </div>

    @if($estado == '1')
     <table class="table">
          <thead>
            <tr>
              <th>Folio</th>
              <th>Código de libro</th>
              <th>matricula</th>
              <th>Nombre</th>
              <th>Turno</th>
              <th>Grado</th>
              <th>Grupo</th>
              <th>Fecha de prestamo</th>
              <th>Fecha de entrega</th>
        
              </th>
            </tr> 
          </thead>
          <tbody>
            @foreach ($results as $result)
                <tr>
                  <td>{{ $result->id }}</td>
                  <td>{{ $result->id_libro }}</td>
                  <td>{{ $result->matricula }}</td>
                  <td>{{ $result->nombre }} {{ $result->apellidos }}</td>
                  <td>{{ $result->turno }}</td>
                  <td>{{ $result->grado}}</td>
                  <td>{{ $result->grupo }}</td>
                  <td>{{ $result->fecha_prestamo->format('d/m/Y') }}</td>
                  <td>{{ $result->fecha_entrega->format('d/m/Y') }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
@endif
@if($estado == '2')

  <table  class="table">
    <thead>
      <tr>
      <th>Matricula</th>
      <th>Nombre</th>
      <th>Grado y grupo</th>
      <th>Tema a investigar</th>
      <th>Entrada</th>
      <th>Salida</th>
    
      
      </tr>
    </thead>
    <tbody>
      @foreach($results as $result)
      <tr>
        <td>{{ $result->matricula }}</td>
        <td>{{ $result->nombre }}</td>
        <td>{{ $result->grado_grupo }}</td>
        <td>{{ $result->tema}}</td>
        <td>{{ $result->entrada->format('d/m/Y H:i') }}</td>
        <td>{{ $result->salida->format('d/m/Y H:i') }}</td>
        
      </tr> 
      @endforeach
    </tbody>
  </table>
@endif    
@if($estado == '3')
     <table class="table">
          <thead>
            <tr>
              <th>Folio</th>
              <th>Código de libro</th>
              <th>Matricula</th>
              <th>Nombre</th>
              <th>Turno</th>
              <th>Grado</th>
              <th>Grupo</th>
              <th>Fecha de prestamo</th>
              <th>Fecha de entrega</th>
              <th>Multa</th>
            </tr> 
          </thead>
          <tbody>
            @foreach ($results as $result)
              @if( $result->multa >= 1  )
                  <tr>
                    <td>{{ $result->id }}</td>
                    <td>{{ $result->id_libro }}</td>
                    <td>{{ $result->matricula }}</td>
                    <td>{{ $result->nombre }} {{ $result->apellidos }}</td>
                    <td>{{ $result->turno }}</td>
                    <td>{{ $result->grado}}</td>
                    <td>{{ $result->grupo }}</td>
                    <td>{{ $result->fecha_prestamo->format('d/m/Y') }}</td>
                    <td>{{ $result->fecha_entrega->format('d/m/Y') }}</td>
                    <td>{{ $result->multa }}</td>
                  </tr>
               @endif   
              @endforeach
          </tbody>
        </table>
@endif 




 
</body>
</html>




