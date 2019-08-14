@extends('layout')


@section('contenido')
@if(session()->has('info'))
    <div class="alert alert-success">{{ session('info') }}</div>
@endif

<div class="row" >
    <div class="col-6">
      <h2>Reportes</h2>

    </div>
    <div class="col-6">
      <a class="btn btn-info btn-sm" href="{{ route('reportes.create')}}">Importar</a>
      <a class="btn btn-info btn-sm" href="{{ route('rlibros')}}">Exportar libros</a>
      <a class="btn btn-info btn-sm" href="{{ route('ralumnos')}}">Exportar alumnos</a>
      <a class="btn btn-info btn-sm" href="{{ route('rmaterias')}}">Reporte por materias</a>
      

    </div>
</div>
     <hr>

<div class="row" >
          

          <div class="ml-auto col-12 ">
            <form method="GET" action="{{ route('reportes.index')}}" autocomplete="off">
            
                <p>
                  <label class="my-1 mr-2" for="inlineFormCustomSelectPrefa"> Elegir Tipo
                        <select class="custom-select " id="inlineFormCustomSelectPrefa " name="opcion">
                              <option 
                                value="prestamos"> Prestamos 
                              </option>
                              <option 
                                    value="visitas"> Visitas 
                              </option>
                              <option 
                                    value="multas"> Multas 
                              </option>      
                            {!! $errors->first('opcion', '<span class=error>:message</span>') !!}
                        </select>
                       </label>
                      <label for="fecha_inicial"><input class="form-control" type="date" name="fecha_inicial" ></label>
                      <label for="fecha_final"><input class="form-control" type="date" name="fecha_final" ></label>
                
                   
                  <input class="btn btn-info" type="submit" value="Buscar">
              
                </p>
            </form>
          </div>
    </div>

    <br>
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
              <th>
                <form method="GET" action="{{ route('eprestamos') }}">
      
                    <input type="hidden" name="date1" value="{{ $date_inicial }}" />
                    <input type="hidden" name="date2" value="{{ $date_final}}" />
                    <input type="hidden" name="estado" value="{{ $estado }}" />


                  <button class="btn btn-success btn-sm" type="submit">Excel</button>
                </form>
                <form method="GET" action="{{ route('pdfprestamos') }}">
      
                    <input type="hidden" name="date1" value="{{ $date_inicial }}" />
                    <input type="hidden" name="date2" value="{{ $date_final}}" />
                    <input type="hidden" name="estado" value="{{ $estado }}" />


                  <button class="btn btn-danger btn-sm" type="submit">PDF</button>
                </form>


               

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
      <th>
       <form method="GET" action="{{ route('eprestamos') }}">
      
                    <input type="hidden" name="date1" value="{{ $date_inicial }}" />
                    <input type="hidden" name="date2" value="{{ $date_final}}" />
                    <input type="hidden" name="estado" value="{{ $estado }}" />
                  <button class="btn btn-success btn-sm" type="submit">Excel</button>
        </form>

       <form method="GET" action="{{ route('pdfprestamos') }}">
      
                    <input type="hidden" name="date1" value="{{ $date_inicial }}" />
                    <input type="hidden" name="date2" value="{{ $date_final}}" />
                    <input type="hidden" name="estado" value="{{ $estado }}" />
                  <button class="btn btn-danger btn-sm" type="submit">PDF</button>
        </form>
    </th>
      
      </tr>
    </thead>
    <tbody>
      @foreach($results as $result)
      <tr>
        <td>{{ $result->matricula }}</td>
        <td>{{ $result->nombre }}</td>
        <td>{{ $result->grado_grupo }}</td>
        <td>{{ $result->tema  }}</td>
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
              <th>
               
                <form method="GET" action="{{ route('pdfprestamos') }}">
      
                   
                    <input type="hidden" name="estado" value="{{ $estado }}" />


                  <button class="btn btn-danger btn-sm" type="submit">PDF</button>
                </form>
              </th>
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