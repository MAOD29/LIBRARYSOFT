<?php

namespace App;
use App\Libro;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    //
     protected $fillable = [
        'nombre',
    ];
    public function libros(){
        return $this->belongsToMany(Libro::class,'assigned_materias');

    } 
    public $timestamps = false;
}
