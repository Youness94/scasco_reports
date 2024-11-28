<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResetPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'L\'adresse e-mail doit être une adresse valide.',
            'email.exists' => 'Aucun utilisateur n\'a été trouvé avec cette adresse e-mail.',
            'token.required' => 'Le jeton de réinitialisation est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
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
