<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePotencialCaseRequest extends FormRequest
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
            'case_name' => 'sometimes',
            'client_id' => 'sometimes|exists:clients,id',
            'branches' => 'nullable|array',
            'branches.*' => 'exists:branches,id',
            'branch_ca' => 'nullable|array',
            'branch_ca.*' => 'numeric|between:.01,999999999999.99',
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
            'case_name.sometimes' => 'Le nom du cas peut être renseigné.',
            'client_id.sometimes' => 'Le client peut être renseigné.',
            'client_id.exists' => 'Le client sélectionné n\'existe pas.',
            'branches.array' => 'Les branches doivent être un tableau.',
            'branches.*.exists' => 'La branche sélectionnée n\'existe pas.',
            'branch_ca.array' => 'Les montants des branches doivent être un tableau.',
            'branch_ca.*.numeric' => 'Les montants des branches doivent être numériques.',
            'branch_ca.*.between' => 'Les montants des branches doivent être entre 0.01 et 999999999999.99.',
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
