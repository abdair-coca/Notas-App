<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNotaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => [
                'required',
                'string',
                'max:120'
            ],

            'contenido' => [
                'required',
                'string'
            ],

            'categoria' => [
                'required',
                Rule::in([
                    'Personal',
                    'Trabajo',
                    'Estudio',
                    'Ideas'
                ])
            ],

            'fijada' => [
                'nullable',
                'boolean'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' =>
                'El título es obligatorio.',

            'titulo.max' =>
                'El título no puede superar los 120 caracteres.',

            'contenido.required' =>
                'El contenido es obligatorio.',

            'categoria.required' =>
                'La categoría es obligatoria.',

            'categoria.in' =>
                'La categoría seleccionada no es válida.',

            'fijada.boolean' =>
                'El valor de fijada debe ser verdadero o falso.'
        ];
    }
}