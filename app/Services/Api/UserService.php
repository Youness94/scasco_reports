<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class UserService
{


    // ================= forgot password logic ================= //
    public function forgotPassword($request)
    {
        $credentials = $request->only('email');

        $status = Password::sendResetLink($credentials);

        return $status === Password::RESET_LINK_SENT
            ? ['status' => 'Success', 'message' => __($status)]
            : ['status' => 'Error', 'message' => __($status)];
    }

    public function resetPassword($request)
    {
        $credentials = $request->only('email', 'token', 'password', 'password_confirmation');

        $status = Password::reset(
            $credentials,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? ['status' => 'Success', 'message' => __($status)]
            : ['status' => 'Error', 'message' => __($status)];
    }
    // ================= end forgot password logic ================= //

    // ================= login logic ================= //

    public function login(array $credentials)
    {
        if ($this->attemptLogin($credentials)) {
            $user = Auth::user();
    
            // Check user status
            if ($user->status !== 'Active') {
                // Log the user out if inactive
                Auth::logout();
    
                return [
                    'user' => null, 
                    'token' => null,
                    'status' => 'error',
                    'message' => 'Votre compte est inactif. Veuillez contacter le support.',
                ];
            }
    
            // Generate token
            $token = $user->createToken('UserToken')->plainTextToken;
    
            return [
                'user' => $user, 
                'token' => $token,
                'status' => 'success',
            ];
        } else {
            Log::info('Tentative de connexion non autorisée');
            return [
                'user' => null,
                'token' => null,
                'status' => 'error',
                'message' => 'Non autorisé',
            ];
        }
    }

    private function attemptLogin(array $credentials)
    {
        return Auth::attempt(['phonenumber' => $credentials['phonenumber_or_email'], 'password' => $credentials['password']]) ||
            Auth::attempt(['email' => $credentials['phonenumber_or_email'], 'password' => $credentials['password']]);
    }
}
