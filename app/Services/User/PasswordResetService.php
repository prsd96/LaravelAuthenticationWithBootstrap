<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\UpdatePasswordRequest;

class PasswordResetService
{
    public function passwordResetEmail(PasswordResetRequest $request): void
    {
        $user = User::whereEmail($request->email)->first();
        
        if ($user) 
        {
            $token = Str::random(64);
            
            PasswordReset::insert([
                'email' => $user->email, 
                'token' => $token, 
                'created_at' => now()
            ]);
            
            $resetURL = route('showPasswordResetForm', $token);
            
            Mail::to($request->email)->send(new PasswordResetMail($resetURL));
        }
    }
    
    public function updateUserPassword(UpdatePasswordRequest $request)
    {
        $user = User::whereEmail(decrypt($request->email))->first();
        
        if (!$user) {
            return 0;
        }
        else
        {
            $user->password = bcrypt($request->password); 
            $user->updated_at = now();
            $user->update();
            $message = 'Your password has been updated successfully. Please login.';
            return $message;        
        }
        
    }
}
