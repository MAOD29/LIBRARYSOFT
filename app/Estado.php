<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    //
    protected $fillable= ['body'];

    public function statusable(){
    	return $this->morphTo();
    }
}
