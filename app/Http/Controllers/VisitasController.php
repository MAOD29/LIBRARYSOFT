<?php

namespace App\Http\Controllers;
use App\Visitas;
use App\Alumno;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Requests\VisitaRequest;

class VisitasController extends Controller
{

     function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:admin',['except' => ['edit','update','show']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $visitas = Visitas::all()->where('estado','no');
        return view('visitas.index',compact('visitas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('visitas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\VisitaRequest  $request
     * @return App\Http\Requests\VisitaRequest
     */
    public function store(VisitaRequest $request)
    {
        //
        $alumno = Alumno::where('matricula',$request->matricula)->first();
        if ($alumno) {
            $g = $alumno->grado.'-'.$alumno->grupo;
            $name = $alumno->nombre.' '.$alumno->apellidos;
        
            $date = Carbon::now();
            $estado = 'no';
            $visitas = Visitas::create([
                'matricula' => $request->matricula,
                'nombre' => $name,
                'turno' => $request->turno,
                'grado_grupo' => $g,
                'tema'  => $request->tema,
                'entrada' => $date,
                'salida' => $date,
                'estado' => $estado
            ]);
        }else{
            return redirect()->route('visitas.index')->with('info','Esta matricula no esta registrada ');
        }

        

        return redirect()->route('visitas.index')->with('info2','Visita creada ');
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
        $date = Carbon::now();
        $estado = 'si';

        $visita = Visitas::findOrFail($id);
        //$this->authorize('update',$user);
        
        $visita->salida = $date;
        $visita->estado = $estado;

        $visita->save();

        //$visita->update($request->only('estado'));

        return redirect()->route('visitas.index')->with('info2','Visita terminada ');
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
}
