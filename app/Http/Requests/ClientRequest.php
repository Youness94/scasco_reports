<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClientRequest extends FormRequest
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
            'client_first_name' => 'required',
            'client_last_name' => 'required',
            'client_address' => 'required',
            'client_phone' => 'required',
            'client_email' => 'required',
            'RC' => 'nullable',
            'ICE' => 'nullable',
            'client_type' => 'required',
            'city_id' => 'required|exists:cities,id',
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
            'client_first_name.required' => 'Le prénom du client est obligatoire.',
        'client_last_name.required' => 'Le nom du client est obligatoire.',
        'client_address.required' => 'L\'adresse du client est obligatoire.',
        'client_phone.required' => 'Le téléphone du client est obligatoire.',
        'client_email.required' => 'L\'email du client est obligatoire.',
        'RC.nullable' => 'Le numéro RC est optionnel.',
        'ICE.nullable' => 'Le numéro ICE est optionnel.',
        'client_type.required' => 'Le type de client est obligatoire.',
        'city_id.required' => 'La ville est obligatoire.',
        'city_id.exists' => 'La ville sélectionnée n\'existe pas.',
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
