<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UserRequest extends FormRequest
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
            // si estamos haciendo un update debe permitir el ingreso del mismo usuario en caso de que no se modifique
            'usuario' => 'required|unique:users,usuario,' . $this->input('id'),
            'role' => 'required',
            'id_personal' => 'required',
        ];


        //si se esta editando el registro.. entonces el password ya no es obligatorio
        if ($this->isMethod('PUT')) {
            if (empty($this->input('password')) == false) {
                $rules['password'] =  'min:8';
            }
        } else {
            $rules['password'] =  'required|min:8';
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
            'id_personal.required' => 'El campo personal es requerido.',
            'role.required' => 'El campo rol es requerido.',
        ];
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
