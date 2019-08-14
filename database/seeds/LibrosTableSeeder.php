<?php

use App\Libro;
use App\Materia;
use Carbon\Carbon;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LibrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Libro::truncate();
        Materia::truncate();
        DB::table('assigned_materias')->truncate();

	    $materia = Materia::create(['nombre' => 'Historia']);

        for ($i=1; $i <101 ; $i++) { 
        	# code...
	        $libro = Libro::create([

	        	'titulo' => "Titulo {$i}",
	        	'author'  => "email{$i}@gmail.com",
	        	'editorial'   => "mensaje{$i}",
	        	'year'   => "1999",
	        	'estado'   => "Mutilado",
                'created_at' => Carbon::now()->subDays(100)->addDays($i)

	        ]);

	        $libro->materias()->save($materia);

        }


    }
}
