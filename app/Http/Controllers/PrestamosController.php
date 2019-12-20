<?php

namespace App\Http\Controllers;


use App\Prestamo;
use App\Libro;
use App\Alumno;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PrestamosController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:admin',['except' => ['show']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //dd($request->get('search'));
        //$prestamos = Prestamo::all()->where('matricula',$request->post('search'));
        if($request->get('search') != ''){
            $val2 = Alumno:: where('matricula',$request->get('search'))->first();
            if(!$val2){
                return redirect()->route('prestamos.index')->with('info','Este Matricula no esta registrada');
            }
        }                 
        $prestamos = Prestamo::where('nombre','like','%'.$request->search.'%')->
                            where('estado','no')
                            ->orWhere('matricula', $request->search)->where('estado','no')->limit(10)->get();
        foreach ($prestamos as $prestamo) {
             $carbon = new Carbon();
             $multa =0;
             $val = $prestamo->fecha_entrega->diffInDays( $carbon);
             if ($val>=1 and $prestamo->estado='no' and $carbon > $prestamo->fecha_entrega) {
                 $multa = $carbon->diffInDays( $prestamo->fecha_entrega);
                 $multa = 5 * $multa;
             }
             $prestamo->multa = $multa;
        }
         $manda=$request->get('search');
        return view('prestamos.index',compact('prestamos','manda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->get('search') != ''){
            $val2 = Alumno:: where('matricula',$request->search)->first();
            if(!$val2){
                return redirect()->route('prestamos.create')->with('info','Este Matricula no esta registrada');
            }
        }                 
            $prestamos = Alumno::all()->where('matricula',$request->search);
            $today = new Carbon();
            $cuenta = Prestamo::all()->where('matricula',$request->search)->where('estado','no')->count();

        return view('prestamos.create',compact('prestamos','cuenta','today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $today = new Carbon();
        $despues = $today->addDay(2);
        
        $validacion = Prestamo::where('id_libro',$request->id_libro)->where('estado','no')->first();
        $val2 = Libro:: where('id',$request->id_libro)->first();
        $val3 = Prestamo:: where('matricula',$request->matricula)->where('estado','no')->count();
    
        if ($validacion) {
            return back()->with('info','Este libro ya esta prestado');
        }elseif (!$val2) {
            return back()->with('info','Este libro no existe');
            
        }elseif ($val3>=2){
            return back()->with('info','El Alumno ya no puede tener más prestamos');
        
        }else{
            $date = new Carbon();

            $prestamo = Prestamo::create( [
                'matricula' => $request->matricula,
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'turno' => $request->turno,
                'grado' => $request->grado,
                'grupo' => $request->grupo,
                'id_libro' => $request->id_libro,           
                'fecha_prestamo' => $date,           
                'fecha_entrega' => $despues, 
                'multa' => '0', 
                'estado' => 'no', 
            ]);

            $prestamos = Prestamo::all()->where('id_libro',$request->id_libro )->where('matricula',$request->matricula )->where('estado','no');
            return view('prestamos.createpdf',compact('prestamos'));
        }
        //return redirect()->route('prestamos.create')
        
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
        $prestamos = Prestamo::all()->where('matricula',$id)->where('estado','no');
        return view ('prestamos.show',compact('prestamos'));
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
        $prestamo = Prestamo::findOrFail($id);
       
        //$this->authorize('todo',$prestamo); 

        return view ('prestamos.edit',compact('prestamo'));
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

       
        $prestamo = Prestamo::findOrFail($id);
         $estado = 'si';
        //$this->authorize('update',$user);
        $prestamo->multa = $request->multa;
        $prestamo->estado = $estado;
        $prestamo->save();
        //$visita->update($request->only('estado'));
        return redirect()->route('prestamos.index')->with('info2','prestamo terminado ');

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
        $prestamo =Prestamo::findOrFail($id);
         //$this->authorize('todo',$prestamo);
        $prestamo->delete();
        return back()->with('info','Prestamo eliminado');
    }

    public function pdf(Request $request){


        //$prestamos = Prestamo::all(); 
        $prestamos = Prestamo::where('nombre','like','%'.$request->search.'%')
                        ->orWhere('matricula', $request->search)->limit(10)->get();

        $pdf = \PDF::loadView('prestamos.pdf', compact('prestamos'));

        return $pdf->download('prestamos.pdf');

    }

    public function pdf2(Request $request){


        
        $prestamos = Prestamo::all()->where('id_libro',$request->get('id_libro') )->where('matricula',$request->get('matricula') );
        foreach ($prestamos as $prestamo) {
             $carbon = new Carbon();
            
             $val = $prestamo->fecha_entrega->diffInDays( $prestamo->fecha_prestamo);
             if ($val>2) {
                 $prestamo->multa = $carbon->diffInDays( $prestamo->fecha_entrega)+$val;
                 $prestamo->multa = 5 * $prestamo->multa;
             }
            
        }

        $pdf = \PDF::loadView('prestamos.form',compact('prestamos'));
        return $pdf->download('create.pdf');
    }


    
}
