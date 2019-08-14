<?php 

namespace App\Repositorios;

use App\Libro;
use Illuminate\Support\Facades\Cache;

class example
{
	public function index($request)
	{
		$key = 'message.page' . request('page', 1);

		return Cache::rememberForever($key, function() use($request) {
			return Libro::where('titulo','like','%'.$request->search.'%')
		                    ->orWhere('id', $request->search)
		                    ->orderBy('created_at', request('sorted','ASC'))
		                    ->paginate(10);
		                });  
	}
}


