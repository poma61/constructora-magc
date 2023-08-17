<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;

class PersonalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'nombres' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'cargo' => 'required',
            'ci' => 'required|unique:personals',
            'ci_expedido' => 'required',
            'telefono' => 'required|numeric',
            'direccion' => 'required',
            'grup_number' => 'required',
        ];
        // Si es una solicitud PUT (editar un registro existente), usar 'sometimes' para el campo 'foto'
        if ($this->isMethod('PUT')) {
            $rules['foto'] = 'sometimes|mimes:jpeg,png,jpg';
        } else {
            // Si es una solicitud POST (crear un nuevo registro), seguir requiriendo el campo 'foto'
            $rules['foto'] = 'required|mimes:jpeg,png,jpg';
        }
        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'grup_number.required' => 'El campo grupo es requerido.',
        ];
    }

    protected function failedValidation(Validator $validator): HttpResponseException
    {
        $response = [
            'status' => false,
            'message' => 'Verificar los campos!',
            'message_errors' => $validator->errors(),
        ];
        throw  new HttpResponseException(response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
