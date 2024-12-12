<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateObjectiveRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'year_objective' => 'sometimes|numeric|between:.01,999999999999.99',
            // 'amount_realized' => 'sometimes|numeric|between:.01,999999999999.99',
            // 'remaining_amount' => 'sometimes|numeric|between:.01,999999999999.99',
            'commercial_id' => 'sometimes|exists:users,id',
        ];
    }
    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'year_objective.sometimes' => 'L\'objectif annuel est obligatoire si présent.',
            'year_objective.numeric' => 'L\'objectif annuel doit être un nombre.',
            'year_objective.between' => 'L\'objectif annuel doit être entre 0.01 et 999999999999.99.',
            // 'amount_realized.sometimes' => 'Le montant réalisé est obligatoire si présent.',
            // 'amount_realized.numeric' => 'Le montant réalisé doit être un nombre.',
            // 'amount_realized.between' => 'Le montant réalisé doit être entre 0.01 et 999999999999.99.',
            // 'remaining_amount.sometimes' => 'Le montant restant est obligatoire si présent.',
            // 'remaining_amount.numeric' => 'Le montant restant doit être un nombre.',
            // 'remaining_amount.between' => 'Le montant restant doit être entre 0.01 et 999999999999.99.',
            'commercial_id.sometimes' => 'L\'identifiant commercial est obligatoire si présent.',
            'commercial_id.exists' => 'L\'identifiant commercial sélectionné n\'existe pas.',
        ];
    }
    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json([
            'success' => false,
            'status_code' => 422,
            'error' => true,
            'message' => 'error de validation',
            'errorList' =>  $validator->errors()
        ], 422));


        parent::failedValidation($validator);
    }
}
