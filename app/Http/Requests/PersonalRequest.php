<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class PersonalRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'nombres' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'cargo' => 'required',
            'ci' => [
                'required',
                //aplicar la validacion unique cuando el campo status este en true siginifica que el registto no esta eliminado
                //aplicamos el ignore cuando sea un update ya que el ci si o si es el mismo porque es una actualizacion del registro
                Rule::unique('personals')->where(function ($query) {
                    $query->where('status', true);
                })->ignore($this->input('id')),
            ],
            'ci_expedido' => 'required',
            'telefono' => 'required|numeric',
            'direccion' => 'required',
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


    protected function failedValidation(Validator $validator): HttpResponseException
    {
        $response = [
            'status' => false,
            'message' => 'Verificar los campos!',
            'message_errors' => $validator->errors(),
        ];
        throw new HttpResponseException(response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
