<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePositionRequest extends FormRequest
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
            'name' => 'sometimes',
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
            'name.sometimes' => 'Le nom est obligatoire.',
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
