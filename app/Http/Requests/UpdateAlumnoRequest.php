<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlumnoRequest extends FormRequest
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

             'matricula' => 'required|unique:alumnos,matricula,'.$this->route('alumno'),
            'name' => 'required',
            'apellidos' => 'required',
            'turno' => 'required',
            'grado' => 'required',
            'grupo' => 'required',
        ];
    }
}
