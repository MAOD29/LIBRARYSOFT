<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;
class pagescontroller extends Controller
{
    //
    public function __construct(){
    	$this->middleware('auth',['only' => ['index']]);
    	
    }



    public function home(){
    	return view('/auth/login');
    }
    public function index(){
    	$this->middleware('auth');
    	return view('index');
    }

    public function grafica(){
         $materias = Materia::withCount('libros')->get();
        return view('grafica',compact('materias'));
    } 
}
 