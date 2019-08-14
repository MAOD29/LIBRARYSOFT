<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    //
    protected $fillable = [
        'matricula', 'nombre', 'apellidos', 'turno','grado','grupo','id_libro','fecha_prestamo', 'fecha_entrega','estado','multa',
    ];

  protected $dates = ['fecha_prestamo', 'fecha_entrega'];

  
    
    public $timestamps = false;
}
