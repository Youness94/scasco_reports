<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ObjectiveRequest extends FormRequest
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
            'year_objective' => 'required|numeric|min:0.01|max:999999999999.99',
            // 'amount_realized' => 'nullable|numeric|between:.01,999999999999.99',
            // 'remaining_amount' => 'nullable|numeric|between:.01,999999999999.99',
            'commercial_id' => 'required|exists:users,id',
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
            'year_objective.required' => 'L\'objectif annuel est obligatoire.',
            'year_objective.numeric' => 'L\'objectif annuel doit être un nombre.',
            'year_objective.min' => 'L\'objectif annuel doit être au moins 0.01.',
            'year_objective.max' => 'L\'objectif annuel ne peut pas dépasser 999999999999.99.',
            'commercial_id.required' => 'L\'identifiant commercial est obligatoire.',
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
