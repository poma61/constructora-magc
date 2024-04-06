<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ContratistaRequest extends FormRequest
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
            "nombres" => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'id_contrato' => 'required',
            'estado' => 'required',
            'monto' => 'required|numeric',
            'descripcion' => 'required',
            'fecha_inicio' => 'required|date',
        ];
        return $rules;
    }

    public function messages(): array
    {
        return [
            'id_contrato.required' => 'El campo n° de contrato es requerido.',
        ];
    }

    protected function failedValidation(Validator $validator):HttpResponseException{
        $response=[
            'status'=>false,
            'message'=>'Verificar los campos!',
            'message_errors'=>$validator->errors(),
        ];

        throw new HttpResponseException(response()->json($response,Response::HTTP_UNPROCESSABLE_ENTITY));
    }

}//class
