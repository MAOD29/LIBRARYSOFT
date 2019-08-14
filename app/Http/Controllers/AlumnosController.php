<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use App\Http\Requests\UpdateAlumnoRequest;
use App\Http\Requests\CreateAlumnoRequest;

class AlumnosController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:admin',['except' => ['show','index']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $alumnos = Alumno::where('name','like','%'.$request->search.'%')
                           ->orWhere('matricula', $request->search)->limit(10)->get();
         
        return view('alumnos.index',compact('alumnos'));
    }  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateAlumnoRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAlumnoRequest $request)
    {

        Alumno::create( $request->all());
        return redirect()->route('alumnos.index')->with('info','Alumno creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumno =Alumno::findOrFail($id);
        return view ('alumnos.show',compact('alumno'));
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
         $alumno =Alumno::findOrFail($id);
        $this->authorize('edit',$alumno);
        return view ('alumnos.edit',compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CreateAlumnoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlumnoRequest $request, $id)
    {
        //
        $alumno = Alumno::findOrFail($id);
        $this->authorize('update',$alumno);
        $alumno->update($request->all()); 
        return back()->with('info','Alumno actualizado');
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
        $alumno =Alumno::findOrFail($id);
        $alumno->delete();
        return back()->with('info','Alumno eliminado');
    }
}
