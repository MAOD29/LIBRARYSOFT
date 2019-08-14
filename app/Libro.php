<?php

namespace App;

use App\Materia;


use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    //
    protected $fillable = [
        'titulo', 'author', 'editorial', 'year','estado'
    ];

    public function materias(){
        return $this->belongsToMany(Materia::class,'assigned_materias');

    } 
    //additional helper relation for the 

   




     
}
