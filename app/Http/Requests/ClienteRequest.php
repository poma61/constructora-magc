<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

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
            'n_de_contacto' => [
                'required',
                'numeric',
                Rule::unique('clientes')->where(function ($query){
                    $query->where('status',true);
                })->ignore($this->input('id')),
            ],
            'ci' => [
                'required',
                //aplicar la validacion unique cuando el campo status este en true siginifica que el registto no esta eliminado
                //aplicamos el ignore cuando sea un update ya que el ci si o su es el mismo porque es una actualizacion del registro
                Rule::unique('clientes')->where(function ($query) {
                    $query->where('status', true);
                })->ignore($this->input('id')),
            ],
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
