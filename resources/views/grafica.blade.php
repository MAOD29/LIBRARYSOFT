@extends('layout')


@section('contenido')

<div id="piechart" style="width: 900px; height: 500px;"></div>


@stop

<script type="text/javascript" src="/js/grafica.js"></script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['materias', 'cantidad'],
            @foreach ($materias as $materia)
              ['{{ $materia->nombre}}', {{ $materia->libros_count}}],
            @endforeach
        ]);
        var options = {
          title: 'Listado de titulos por materia'
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
    

