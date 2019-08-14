<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    //

    protected $fillable = [
        'matricula', 'name', 'apellidos','turno','grado','grupo',
    ];


    
    
}
