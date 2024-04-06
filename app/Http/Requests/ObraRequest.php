<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;

class ObraRequest extends FormRequest
{

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
            'id_contrato' => 'required',
            'estado' => 'required',
            'fecha_inicio' => 'required',
            'fecha_finalizacion' => 'required',
            'monto_pago_contratista' => 'required',
            'descripcion' => 'required',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'id_contrato.required' => 'El campo n° de contrato es requerido.',
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
