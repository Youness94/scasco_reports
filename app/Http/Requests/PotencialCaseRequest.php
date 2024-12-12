<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PotencialCaseRequest extends FormRequest
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
            'case_name' => 'required',
            'client_id' => 'required|exists:clients,id',
            'branches' => 'required|array',
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
            'case_name.required' => 'Le nom du cas est obligatoire.',
            'client_id.required' => 'Le client est obligatoire.',
            'client_id.exists' => 'Le client sélectionné n\'existe pas.',
            'branches.required' => 'Les branches sont obligatoires.',
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
