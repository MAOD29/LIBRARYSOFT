<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>reporte</title>
    <link rel="stylesheet" href="">

    

</head>
<body>
    
	<div class="text">
        <p> <strong> COLEGIO DE BACHILLERES <br>
        PLANTEL 06  </strong></p>
    </div>
    
		
    
    <div class="text2">
        <p> <strong>  <br> DEPARTAMENTO DE SERVICIOS ESTUDIANTILES
        	<br>OFICINA DE BIBLIOTECAS
 </strong></p>
    </div>

    
    
    
    <div class="text2">
        <p> <strong>  <br> BIBLIOTECA
    PRESTAMOS VIGENTES </strong></p>
    </div>

   <table class="table">
			
			<thead>
				<tr>
					<th>Folio </th>
					<th>CódigoLibro</th>
					<th>matricula </th>
					<th>Nombre  </th>
					
					<th>Turno </th>
					<th>Grado</th>
				
					<th>FechaPrestamo</th>
					<th>FechaEntrega</th>
					<th>Multa</th>
					
					
					

				</tr> 
			</thead>

			<tbody>
				@foreach ($prestamos as $prestamo)

						<tr>
							
							<td>{{ $prestamo->id }}</td>
							<td>{{ $prestamo->id_libro }}</td>
							<td>{{ $prestamo->matricula }}</td>
							<td>{{ $prestamo->nombre }}</td>
							<td>{{ $prestamo->turno }}</td>
							<td>{{ $prestamo->grado}} {{ $prestamo->grupo }}</td>
						
							<td>{{ $prestamo->fecha_prestamo->toDateString() }}</td>
							<td>{{ $prestamo->fecha_entrega->toDateString() }}</td>
							<td>{{ $prestamo->multa }}</td>
							
							
							
						</tr>
					

				@endforeach
			</tbody>
		</table>
</body>
</html>



















 