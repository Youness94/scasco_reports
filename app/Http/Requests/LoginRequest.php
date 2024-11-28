<?php

namespace App\Http\Requests;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
    public function rules()
    {
        return [
            'phonenumber_or_email' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!User::where('email', $value)->orWhere('phonenumber', $value)->exists()) {
                        $fail('The selected email or phone number does not exist.');
                    }
                },
            ],
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'phonenumber_or_email.required' => 'Le téléphone ou l\'e-mail est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'phonenumber_or_email.exists' => 'L\'adresse e-mail ou le numéro de téléphone sélectionné n\'existe pas.',
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
