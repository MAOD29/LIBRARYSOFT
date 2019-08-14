<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitas extends Model
{
    //
    protected $fillable = [
        'matricula', 'entrada', 'salida','tema','estado','nombre','grado_grupo'
    ];

     protected $dates = ['entrada', 'salida'];

    public $timestamps = false;

}
