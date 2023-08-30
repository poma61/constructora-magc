<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ClienteRequest extends FormRequest
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
            'n_de_contacto' => 'required|numeric',
            'ci' => 'required|unique:clientes,ci,'.$this->input('id'),
            'ci_expedido' => 'required',
            'estado' => 'required',
            'descripcion' => 'required',
            'monto_inicial' => 'required|numeric',
            'fecha_reunion' => 'required|date',
            'hora_reunion' => 'required',           
            'seguimiento' => 'required',
        ];

        return $rules;
    }

    protected function failedValidation(Validator $validator): HttpResponseException
    {

        $response = [
            'status' => false,
            'message' => 'Verificar los campos!',
            'message_errors' => $validator->errors(),
        ];

        throw new HttpResponseException(response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}//class
