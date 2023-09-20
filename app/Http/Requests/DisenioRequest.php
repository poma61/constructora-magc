<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;

class DisenioRequest extends FormRequest
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
        return [
            "id_cliente" => 'required',
            "requerimiento" => 'required',
            "fecha" => 'required|date',
            "arquitecto" => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'id_cliente.required' => 'El campo nombre cliente es requerido.',
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
