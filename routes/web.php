<?php

/*
DB::listen(function($query){

	echo "<pre>{$query->sql}</pre>";
});
*/
Route::get('/', function () {
    return view('home');
});

Route::get('/grafica', ['as' => 'grafica', 'uses' => 'pagescontroller@grafica']);
Route::get('/', ['as' => 'home', 'uses' => 'pagescontroller@home']);
Route::get('/index', ['as' => 'index', 'uses' => 'pagescontroller@index']);
Route::get('/home', ['as' => 'home', 'uses' => 'pagescontroller@index']);

Route::resource('usuarios','UsersController');
Route::resource('alumnos','AlumnosController');
Route::resource('libros','LibrosController');
Route::resource('visitas','VisitasController');
Route::resource('prestamos','PrestamosController');
Route::resource('materiasc','MateriasController');
Route::get('/reporte-prestamo', ['as' => 'rprestamo', 'uses' => 'PrestamosController@pdf']);
Route::get('/reporte-creado', ['as' => 'crprestamo', 'uses' => 'PrestamosController@pdf2']);


Route::resource('reportes','ReportesController');
Route::get('/reportes-libros', ['as' => 'rlibros', 'uses' => 'ReportesController@libros']);
Route::get('/reportes-alumnos', ['as' => 'ralumnos', 'uses' => 'ReportesController@alumnos']);
Route::get('/reportes-materias', ['as' => 'rmaterias', 'uses' => 'ReportesController@materias']);

Route::get('/exportar-prestamo', ['as' => 'eprestamos', 'uses' => 'ReportesController@eprestamos']);
Route::get('/pdf-prestamo', ['as' => 'pdfprestamos', 'uses' => 'ReportesController@pdfprestamos']);

Route::post('/importar-alumno', ['as' => 'ialumno', 'uses' => 'ReportesController@importaralumnos']);
Route::post('/importar-libro', ['as' => 'ilibros', 'uses' => 'ReportesController@importarlibros']);




Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login');
Route::get('logout','Auth\LoginController@logout');
