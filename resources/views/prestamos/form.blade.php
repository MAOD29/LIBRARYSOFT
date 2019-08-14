<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LibrarySoft</title>
    
    <link href="" rel="stylesheet">
</head>
<body>
@foreach ($prestamos as $prestamo)

				
				
					


				




    <div class="logo" >
    <img  src="" alt="">
</div>
<br><br>

<div class="colegio">
<p>  <strong>COLEGIO DE BACHILLERES </strong> <br>
    <strong>PLANTEL 06</strong>
</p> 
</div>

<div class="biblioteca">
<p> <strong> BIBLIOTECA<br>
PRÉSTAMO EXTERNO DE MATERIAL BIBLIOGRAFÍCO
</strong>
</p>
</div>

<form class="formu">
        <fieldset>
          <legend>REPORTES</legend>
         
          <label for="nombre">FECHA PRESTAMO</label>
          <input type="text"  value="{{ $prestamo->fecha_prestamo->format('d/m/Y') }}" />
          <br>
            
         
         <br>
          <label for="nombre">FECHA ENTREGA </label>
          <input type="text" value="{{ $prestamo->fecha_entrega->format('d/m/Y') }}" />
            
          
         
        </fieldset>
        </form>

        <form class="formu2">
                <fieldset>
                  <legend>LIBRO</legend>
                 
                  <label for="nombre">CODIGO DE LIBRO</label>
                  <input type="text" value=" {{ $prestamo->id_libro }}" />
                    <br><br>
                 
                </fieldset>
                </form>

                        <form class="formu4">
                          <fieldset>
                            <legend>DATOS ALUMNO</legend>
                           
                            <label for="nombre">NOMBRE DEL ALUMNO</label>
                            <input type="text" value="{{ $prestamo->nombre }}"/>

                              <br><br>
                            <label for="apellidos">MATRÍCULA</label>
                            <input type="text"  value="{{ $prestamo->matricula }}" />
                           <br><br>
                            <label for="nombre">GRUPO</label>
                            <input type="text" value="{{ $prestamo->grupo }}"/>
							<br><br>
                            <label for="nombre">TURNO</label>
                            <input type="text" value="{{ $prestamo->turno }}" />
                            <br><br>
                            <label for="nombre">FIRMA DEL SOLICITANTE</label>
                            <input type="text" />
                            <br><br>
                            <label for="nombre">NOMBRE Y FIRMA DEL BIBLIOTECARIO</label>
                            <input type="text" />
                           
                          </fieldset>
                          </form>
                          <div class="nota">
                            <p>NOTA <br>
                              (LOS PRESTAMOS A DOMICILIO SERÁN UNICAMENTE POR 48 HORAS, CON 2 RENOVACIONES) <br>
                              EN CASO DE HACER OMISO LAS FECHAS DE DEVOLUCIÓN Y EXTRAVÍO DEL MATERIAL SE APLICARÁ MULTA.
                            </p>
                          </div>


                   
       


@endforeach



</body>
</html>
