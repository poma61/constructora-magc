<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class AuthProfileRequest extends FormRequest
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
            'usuario' => 'required|unique:users,usuario,' . $this->input('id_usuario'),
            'new_password' => 'required|min:8',
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    // Verificar si la contraseña antigua es correcta
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('La contraseña antigua no es válida.');
                    }
                },
            ],
        ];

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
            'new_password.required' => 'El campo contraseña nueva es requerido.',
            'new_password.min' => 'El campo contraseña nueva debe tener al menos 8 caracteres.',
            'old_password.required' => 'El campo contraseña anterior es requerido.',
        ];
    }

    protected function failedValidation(Validator $validator): HttpResponseException
    {
        $response = [
            'status' => false,
            'message' => 'Verificar los campos solicitados!',
            'message_errors' => $validator->errors(),
        ];

        throw new HttpResponseException(response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
