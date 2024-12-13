<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class ForgotPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'L\'adresse e-mail doit être une adresse valide.',
            'email.exists' => 'Aucun utilisateur n\'a été trouvé avec cette adresse e-mail.',
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
