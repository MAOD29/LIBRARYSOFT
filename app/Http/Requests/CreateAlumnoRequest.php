<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAlumnoRequest extends FormRequest
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
            'matricula' => 'required|max:18|unique:alumnos,matricula'.$this->route('alumnos'),
            'name' => 'required|max:20',
            'apellidos' => 'required|max:20',
            'turno' => 'required',
            'grado' => 'required|max:2',
            'grupo' => 'required|max:5',
        ];
    }
}
