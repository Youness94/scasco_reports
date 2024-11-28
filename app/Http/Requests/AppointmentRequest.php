<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AppointmentRequest extends FormRequest
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
           'date_appointment' => 'required',
            'place' => 'required',
            'status' => 'nullable',
            'potencial_case_id' => 'required|exists:potencial_cases,id',
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
           'date_appointment.required' => 'La date du rendez-vous est obligatoire.',
        'place.required' => 'Le lieu du rendez-vous est obligatoire.',
        'status.nullable' => 'Le statut est optionnel.',
        'potencial_case_id.required' => 'L\'ID du cas potentiel est obligatoire.',
        'potencial_case_id.exists' => 'Le cas potentiel avec cet ID n\'existe pas.',
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
