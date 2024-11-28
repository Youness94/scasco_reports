<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateClientRequest extends FormRequest
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
            'client_first_name' => 'sometimes',
            'client_last_name' => 'sometimes',
            'client_address' => 'sometimes',
            'client_phone' => 'sometimes',
            'client_email' => 'sometimes',
            'RC' => 'nullable',
            'ICE' => 'nullable',
            'client_type' => 'sometimes',
            'city_id' => 'sometimes|exists:cities,id',
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
            'client_first_name.sometimes' => 'Le prénom du client est obligatoire.',
        'client_last_name.sometimes' => 'Le nom du client est obligatoire.',
        'client_address.sometimes' => 'L\'adresse du client est obligatoire.',
        'client_phone.sometimes' => 'Le téléphone du client est obligatoire.',
        'client_email.sometimes' => 'L\'email du client est obligatoire.',
        'RC.nullable' => 'Le numéro RC est optionnel.',
        'ICE.nullable' => 'Le numéro ICE est optionnel.',
        'client_type.sometimes' => 'Le type de client est obligatoire.',
        'city_id.sometimes' => 'La ville est obligatoire.',
        'city_id.exists' => 'La ville sélectionnée n\'existe pas.',
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
