<?php

namespace App\Http\Controllers;
use App\Repositorios\example;
use Illuminate\Http\Request;
use App\user;
use App\Libro;
use App\Materia;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\UpdateLibroRequest;
use App\Http\Requests\CreateLibroRequest;

class LibrosController extends Controller
{
    protected $messeges;

    function __construct(example $messeges)
    {
        $this->middleware('auth');
        $this->middleware('roles:admin',['except' => ['edit','update','show']]);
         $this->messeges = $messeges;
        
    }
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //esto es para usar redis pero se tiene que instalar
        //
        Cache::flush();
        $key = 'message.page' . request('page', 1);
		$libros = Cache::rememberForever($key, function() use($request) {
			return Libro::with(['materias'])->where('titulo','like','%'.$request->search.'%')
		                    ->orWhere('id', $request->search)
		                    ->orderBy('created_at', request('sorted','ASC'))
		                    ->paginate(10);
                        });  
                     
        return view('libros.index',compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        //
        $materias = Materia::pluck('nombre','id');
        return view('libros.create',compact('materias'));
        
    } 

    /** 
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateLibroRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLibroRequest $request)
    {
        //
        $libro = Libro::create( $request->all());
        $libro->materias()->attach($request->materias);
        Cache::flush();
        return redirect()->route('libros.index')->with('info','Libro Creado');
        
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
        $libro =Libro::findOrFail($id);
        return view ('libros.show',compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $libro = Libro::findOrFail($id);
        $materias = Materia::pluck('nombre','id');
        $this->authorize('todo',$libro); 
        return view ('libros.edit',compact('libro','materias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateLibroRequest;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLibroRequest $request, $id)
    {
        //
        $libro = Libro::findOrFail($id);
        $this->authorize('todo',$libro);
        $libro->update($request->all());
        $libro->materias()->sync($request->materias);
        Cache::flush();
        return redirect()->route('libros.index')->with('info','Libro Actualizado');
        
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
         $libro =Libro::findOrFail($id);
         $this->authorize('todo',$libro);
        $libro->delete();
        Cache::flush();
        return back()->with('info','Libro eliminado');
    }
}
