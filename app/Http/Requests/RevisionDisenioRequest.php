<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;

class RevisionDisenioRequest extends FormRequest
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
            'fecha_rev_plano'=>'required|date',
            'fecha_rev_3D'=>'required|date',
            'id_disenio'=>'required',
        ];
    }


    public function messages(): array
    {
        return [
            'fecha_rev_plano.required' => 'El campo fecha revision plano es requerido.',
            'fecha_rev_3D.required' => 'El campo fecha revision 3D es requerido.',
            'fecha_rev_plano.date' => 'El campo fecha revision plano no es una fecha valida.',
            'fecha_rev_3D.date' => 'El campo fecha revision 3D no es una fecha valida.',
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
