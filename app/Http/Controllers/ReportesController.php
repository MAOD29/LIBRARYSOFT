<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\user;
use App\Libro;
use App\Materia;
use App\Alumno;
use App\Prestamo;
use App\Visitas;
use App\assigned_materias;



use Carbon\Carbon;

use App\Http\Requests\CreateAlumnoRequest;


class ReportesController extends Controller
{
   function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:admin',['except' => ['edit','update','show']]);
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Reservation::whereBetween('reservation_from', [$from, $to])->get();
        $results = Prestamo::all();
        $estado = '';

        $date_inicial = new Carbon($request->fecha_inicial." 00:00:00");
        $date_final = new Carbon($request->fecha_final." 23:59:59");

        if($request->opcion == 'prestamos'){
            $results = Prestamo::all()->where('fecha_prestamo','>=',$date_inicial)
                                      ->where('fecha_entrega','<=',$date_final)
                                      ->where('estado','si');
            $estado = '1';

        }elseif ($request->opcion == 'visitas') {
            $results = Visitas::all()->where('entrada','>=',$date_inicial)
                                      ->where('salida','<=',$date_final)
                                      ->where('estado','si');
            $estado = '2';
        }elseif($request->opcion == 'multas'){
            $results = Prestamo::all()->where('estado','si');
            $estado = '3';
         }

        return view('reportes.index',compact('results','estado','date_inicial','date_final'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materias = Materia::withCount('libros')->get();
        return view('reportes.create',compact('materias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //// metodos de reportes
    public function libros(){

        \Excel::create('libros', function($excel) {

            $libros = Libro::all();
            $materias = Materia::pluck('nombre','id');

            $excel->sheet('Users', function($sheet) use($libros) {

                $sheet->setWidth('A', 20);
                $sheet->setWidth('B', 30);
                $sheet->setWidth('C', 30);
                $sheet->setWidth('D', 25);
                $sheet->setWidth('E', 20);
                $sheet->setWidth('F', 30);

                $sheet->cells('A2:F2',function($cells){

                    $cells->setBackground('#D8E4BC');
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                   
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '12',
                        'bold'       =>  true
                    ));
                });

                $sheet->cells('A3:F1000',function($cells){

                   
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                   
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '11',
                    ));
                });
                $sheet->mergeCells('A1:F1');

                $sheet->cells('A1:F1',function($cells){

                    $cells->setBackground('#B7DEE8');
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                   
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '15',
                        'bold'       =>  true
                    ));
                });



                $sheet->row(1, ['INVENTARIO DE LIBROS EN EXISTENCIA DENTRO DE LA BIBLIOTECA.'])->setBorder('A1:F1', 'double');

                $sheet->row(2, ['CÓDIGO', 'TITULO', 'AUTHOR', 'EDITORIAL', 'PUBLICACION','MATERIA'])->setBorder('A1:F1', 'double');

               
                
                //recorrer el array para insertar datos
                    foreach($libros as $index => $libro) {
                        $sheet->row($index+3, [
                            $libro->id, $libro->titulo, $libro->author, $libro->editorial, $libro->year,$libro->materias->pluck('nombre')->implode(' - ')
                        ]); 
                    }
               
            });
           

        })->export('xls');

    }

    public function materias(){
     

      
        \Excel::create('Materias', function($excel) {
            $libros= Libro::with(['materias'])->get()->count();
            $materias = Materia::withCount('libros')->get();
            $inde = 3;
            $excel->sheet('Materias', function($sheet) use($materias,$inde,$libros)  {
                $sheet->setWidth('A', 27);
                $sheet->setWidth('B', 27);
                $sheet->setWidth('C', 27);
                $sheet->setWidth('D', 44);
                $sheet->cells('A3:D3',function($cells){
                    $cells->setBackground('#D8E4BC');
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                   
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '12',
                        'bold'       =>  true
                    ));
                });
                $sheet->cells('A4:F100',function($cells){
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                   
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '11',
                    ));
                });
                $sheet->mergeCells('A1:D2');
                $sheet->cells('A1:D2',function($cells){
                    $cells->setBackground('#B7DEE8');
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                   
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '13',
                        'bold'       =>  true
                    ));
                });
                $sheet->row(1, ['RELACIÓN DE LIBROS ACTUALES EXISTENTES EN LA BIBLIOTECA, ACORDES A PLANES Y PROGRAMAS DE ESTUDIO'])->setBorder('A1:D2', 'double');
                $sheet->row(3, ['CÓDIGO','TITULOS ACTUALES', 'PIEZAS/VOLÚMENES', 'OBSERVACIONES'])->setBorder('A3:D3', 'double');
                //recorrer el array para insertar datos
                    foreach($materias as $index => $materia) {
                       
                        $sheet->row($index+4, [
                            $materia->id,$materia->nombre, $materia->libros_count,'todos los libros son por pieza'
                            
                        ]); 
                        $inde = $inde+1;
                    }
                    $cell = $inde+2;
                  $sheet->mergeCells('A'.$cell.':B'.$cell);  
                 $sheet->row($inde+2, ['TOTAL DE LIBROS: '.$libros])->setBorder('A'.$cell.':B'.$cell, 'double')->setFontSize(12);


            });
        })->export('xls');

    }
    public function alumnos(){

        \Excel::create('alumnos', function($excel) {

            $alumnos = Alumno::all();

            $excel->sheet('alumnos', function($sheet) use($alumnos) {

              $sheet->setWidth('A', 20);
                $sheet->setWidth('B', 33);
                $sheet->setWidth('C', 33);
                $sheet->setWidth('D', 25);
                $sheet->setWidth('E', 20);
                $sheet->setWidth('F', 20);


                $sheet->cells('A2:F2',function($cells){

                    $cells->setBackground('#D8E4BC');
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                   
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '12',
                        'bold'       =>  true
                    ));
                });

                $sheet->cells('A3:F1000',function($cells){

                   
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                   
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '11',
                    ));
                });
                $sheet->mergeCells('A1:F1');

                $sheet->cells('A1:F1',function($cells){

                    $cells->setBackground('#B7DEE8');
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                   
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '15',
                        'bold'       =>  true
                    ));
                });
                $sheet->row(1, ['ALUMNOS EN EL SISTEMA'])->setBorder('A1:F1', 'double');
                $sheet->row(2, ['MATRICULA', 'NOMBRE', 'APELLIDOS', 'TURNO', 'GRADO','GRUPO'])->setBorder('A1:F1', 'double');
                //recorrer el array para insertar datos
                    foreach($alumnos as $index => $alumno) {
                        $sheet->row($index+3, [
                            $alumno->matricula, $alumno->name, $alumno->apellidos, $alumno->turno, $alumno->grado,$alumno->grupo
                        ]); 
                    }
            });

        })->export('xls');
    }

   
 

    public function importarlibros(Request $request){
   
        \Excel::load($request->excel, function($reader) {

             //
             foreach ($reader->get() as $book) {
                $libros = Libro::where('titulo',$book->titulo)->first();
                $materia = Materia::where('nombre',$book->materia)->first();
                if (count($libros) == 0) {
                    if (empty( $book->titulo)) {
                         //return view('reportes.index');   
                    }else{
                          $libro = Libro::create([
                         'titulo' => $book->titulo,
                         'author' =>$book->author,
                         'editorial' =>$book->editorial,
                         'year' =>$book->publicacion,
                         ]);
                          $libro->materias()->attach($materia);
                    }
                } 
                }  
            });
        return redirect()->route('reportes.index')->with('info','Libros actualizado');
    }

    public function importaralumnos(Request $request){

        \Excel::load($request->excel, function($reader) {
             foreach ($reader->get() as $book) {
                $alumnos = Alumno::where('matricula',$book->matricula)->first();

                if (count($alumnos) == 0) {
                    if (empty( $book->matricula)) {
                         return view('reportes.index');    
                    }else{
                          Alumno::create([
                         'matricula' => $book->matricula,
                         'name' =>$book->nombre,
                         'apellidos' =>$book->apellidos,
                         'turno' =>$book->turno,
                         'grado' =>$book->grado,
                         'grupo' =>$book->grupo,
                         ]);
                    }
                }     
                }  

            });
         return redirect()->route('reportes.index')->with('info','alumnos actualizado');
    }

    public function eprestamos(Request $request){

        $date_inicial = new Carbon($request->date1);
        $date_final = new Carbon($request->date2);

        if($request->estado == '1'){

            \Excel::create('prestamos', function($excel) use($date_inicial,$date_final) {
             $results = Prestamo::all()->where('fecha_prestamo','>=',$date_inicial)
                                      ->where('fecha_entrega','<=',$date_final);
            $excel->sheet('prestamos', function($sheet) use($results,$date_inicial,$date_final) {
               $sheet->setWidth('A', 10);
                $sheet->setWidth('B', 15);
                $sheet->setWidth('C', 25);
                $sheet->setWidth('D', 25);
                $sheet->setWidth('E', 20);
                $sheet->setWidth('F', 20);
                $sheet->setWidth('G', 10);
                $sheet->setWidth('H', 10);
                $sheet->setWidth('I', 25);
                $sheet->setWidth('J', 25);
                $sheet->cells('A2:J2',function($cells){
                    $cells->setBackground('#D8E4BC');
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '12',
                        'bold'       =>  true
                    ));
                });
                $sheet->cells('A3:J1000',function($cells){
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                   
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '11',
                    ));
                });
                $sheet->mergeCells('A1:J1');

                $sheet->cells('A1:J1',function($cells){

                    $cells->setBackground('#B7DEE8');
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                   
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '15',
                        'bold'       =>  true
                    ));
                });
                $sheet->row(1, ['LISTA DE PRESTAMOS DE '.$date_inicial->format('d-m-Y').' HASTA '.$date_final->format('d-m-Y')])->setBorder('A1:J1', 'double');
                $sheet->row(2, ['FOLIO','CODIGÓ_LIBRO', 'MATRICULA', 'NOMBRE', 'APELLIDOS', 'TURNO','GRADO','GRUPO','FECHA PRESTAMO','FECHA ENTREGA'])->setBorder('A1:J1', 'double');
                //recorrer el array para insertar datos
                    foreach($results as $index => $result) {
                        $sheet->row($index+3, [
                            $result->id, $result->id_libro, $result->matricula, $result->nombre, $result->apellidos,$result->turno,$result->grado,$result->grupo,$result->fecha_prestamo->format('d-m-Y'),$result->fecha_entrega->format('d-m-Y')
                        ]); 
                    }
                    });

                })->export('xls');
                return redirect()->route('reportes.index')->with('info','Archivo Descargado');


        }elseif ($request->estado == '2') {
             \Excel::create('visitas', function($excel) use($date_inicial,$date_final) {
                
                $results = Visitas::all()->where('entrada','>=',$date_inicial)
                                      ->where('salida','<=',$date_final)
                                      ->where('estado','si');

            $excel->sheet('visitas', function($sheet) use($results,$date_inicial,$date_final) {
                $sheet->setWidth('A', 15);
                $sheet->setWidth('B', 30);
                $sheet->setWidth('C', 25);
                $sheet->setWidth('D', 25);
                $sheet->setWidth('E', 20);
                $sheet->setWidth('F', 20);
                $sheet->setWidth('G', 20);
           
                $sheet->cells('A2:G2',function($cells){
                    $cells->setBackground('#D8E4BC');
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '12',
                        'bold'       =>  true
                    ));
                });
                $sheet->cells('A3:J100',function($cells){
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                   
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '11',
                    ));
                });
                $sheet->mergeCells('A1:G1');

                $sheet->cells('A1:G1',function($cells){

                    $cells->setBackground('#B7DEE8');
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                   
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '13',
                        'bold'       =>  true
                    ));
                });
                $sheet->row(1, ['LISTA DE VISITAS DE '.$date_inicial->format('d-m-Y').' HASTA '.$date_final->format('d-m-Y')])->setBorder('A1:G1', 'double');
                $sheet->row(2, ['FOLIO', 'MATRICULA','NOMBRE','GRADO Y GRUPO' ,'TEMA', 'ENTRADA', 'SALIDA'])->setBorder('A1:G1', 'double');
                //recorrer el array para insertar datos
                    foreach($results as $index => $result) {
                        $sheet->row($index+3, [
                            $result->id, $result->matricula,$result->nombre,$result->grado_grupo, $result->tema, $result->entrada,$result->salida
                        ]); 
                    }
                    });

                })->export('xls');
                return redirect()->route('reportes.index')->with('info','Archivo Descargado');
        }else{

        }
        

    }
    public function pdfprestamos(Request $request){
        $date_inicial = new Carbon($request->date1);
        $date_final = new Carbon($request->date2);

        $estado= $request->estado;

        if($request->estado == '1'){

            
             $results = Prestamo::all()->where('fecha_prestamo','>=',$date_inicial)
                                      ->where('fecha_entrega','<=',$date_final);

                $pdf = \PDF::loadView('reportes.pdf', compact('results','estado'));
                return $pdf->download('prestamos.pdf');

        }elseif ($request->estado == '2') {

               $results = Visitas::all()->where('entrada','>=',$date_inicial)
                                      ->where('salida','<=',$date_final)
                                      ->where('estado','si');


                $pdf = \PDF::loadView('reportes.pdf', compact('results','estado'));
                return $pdf->download('visitas.pdf');
                
        }elseif($request->estado == '3'){

             $results = Prestamo::all()->where('estado','si');   
              $estado = '3';
            $pdf = \PDF::loadView('reportes.pdf', compact('results','estado'));
            return $pdf->download('multas.pdf');
        }
        
    }

   
}
