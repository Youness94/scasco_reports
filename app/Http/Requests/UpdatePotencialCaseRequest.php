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
            'client_id' => 'sometimes|exists:clients,id',
            'services' => 'sometimes|array',
            'services.*' => 'exists:services,id',
            'branches' => 'nullable|array',
            'branches.*' => 'exists:branches,id',
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
            'client_id.sometimes' => 'Le client est obligatoire.',
            'client_id.exists' => 'Le client spécifié n\'existe pas.',
            'services.sometimes' => 'Les services sont obligatoires.',
            'services.array' => 'Les services doivent être fournis sous forme de tableau.',
            'services.*.exists' => 'Un ou plusieurs services spécifiés n\'existent pas.',
            'branches.array' => 'Les branches doivent être fournies sous forme de tableau.',
            'branches.*.exists' => 'Une ou plusieurs branches spécifiées n\'existent pas.',
        ];
    }
    public function failedValidation(Validator $validator){

        throw new HttpResponseException(   response()->json(  [
            'success' => false,
            'status_code' => 422,
            'error' => true,
            'message'=> 'error de validation',
            'errorList'=>  $validator->errors()
        ],422) );


        parent::failedValidation($validator);

    }
}
