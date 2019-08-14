<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLibroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            //'titulo' => 'required|unique:libros,titulo'.$this->route('libros'),
            'titulo' => 'required|max:40',
            'author' => 'required|max:30',
            'editorial' => 'required|max:30',
            'year' => 'required|max:4',
            
        ];
    }
}
