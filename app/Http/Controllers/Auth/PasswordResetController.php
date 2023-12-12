<?php

//send email, verify code, update password
//toekn in password_resets table

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordResetRequest;
use App\Services\User\PasswordResetService;
use App\Http\Requests\UpdatePasswordRequest;

class PasswordResetController extends Controller
{
    public function forgotPassword()
    {
        return view('auth/password/forgot-password');
    }
    
    public function sendPasswordResetLink(PasswordResetRequest $request, PasswordResetService $passwordResetService)
    {
        $passwordResetService->passwordResetEmail($request);
        return view('auth/password/password-reset-alert');
    }
    
    public function showPasswordResetForm($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();

        // Check if the token is still valid
        if (!$passwordReset || $passwordReset->expires_at < now()) {
            return view('error/user/user_unverified');
        }

        $email = $passwordReset->email;
        return view('auth/password/password-reset-form', ['token' => $token, 'email' => $email]);
    }
    
    public function updatePassword(UpdatePasswordRequest $request, PasswordResetService $passwordResetService)
    {
        $updatePassword = $passwordResetService->updateUserPassword($request);
        
        if($updatePassword)
        {
            return redirect()->route('login')->with(['type'=>'success', 'message' => $updatePassword]);
        }
        else
        {
            return view('error/user/user_unverified');
        }
    }
}
