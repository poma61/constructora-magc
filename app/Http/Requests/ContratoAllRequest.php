<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ContratoAllRequest extends FormRequest
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
            //contrato
            'id_cliente'=> 'required',
            'fecha_firma_contrato'=> 'required|date',
            'monto_total_construccion'=> 'required|numeric',
            'couta_inicial'=> 'required|numeric',
            'couta_mensual'=> 'required|numeric',
            'fecha_pago_couta_mensual'=> 'required|date',
            'descripcion'=> 'required',

            //detalle contrato
            'n_lote' => 'required',
            'n_uv' => 'required',
            'zona' => 'required',
            'barrio' => 'required',
            'calle' => 'required',
            'superficie_terreno' => 'required|numeric',
            'numero_distrito' => 'required',
            'numero_identificacion_terreno' => 'required',
            'norte_medida_terreno' => 'required',
            'norte_colinda_lote' => 'required',
            'sur_medida_terreno' => 'required',
            'sur_colinda_lote' => 'required',
            'este_medida_terreno' => 'required',
            'este_colinda_lote' => 'required',
            'oeste_medida_terreno' => 'required',
            'oeste_colinda_lote' => 'required',
            'valor_monto_total_construccion_literal' => 'required',
            'valor_couta_inicial_literal' => 'required',
            'valor_couta_mensual_literal' => 'required',
            'cantidad_couta_mensual' => 'required|numeric',
            'lugar_firma_contrato' => 'required',
        ];

        return $rules;
    }
    
    protected function failedValidation(Validator $validator):HttpResponseException{
        $response=[
            'status'=>false,
            'message'=>'Verificar los campos!',
            'message_errors'=>$validator->errors(),
        ];

        throw new HttpResponseException(response()->json($response,Response::HTTP_UNPROCESSABLE_ENTITY));
    }

   //public function 
}
