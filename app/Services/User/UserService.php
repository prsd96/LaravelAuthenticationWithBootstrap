<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\EmailVerificationMail;
use App\Models\UserEmailVerification;
use Illuminate\Support\Facades\Mail;

class UserService
{
    public function emailVerificationEmail(User $user): void
    {
        $user = User::whereEmail($user->email)->first();

        if ($user) 
        {
            $token = Str::random(64);

            UserEmailVerification::insert([
                'user_id' => $user->id,
                'email' => $user->email, 
                'token' => $token,
                'created_at' => now()
            ]);

            $verificationURL = route('verifyUserEmail', $token);
            Mail::to($user->email)->send(new EmailVerificationMail($verificationURL));
        }

    }

    public function verifyingUserEmail($token)
    {
        $data = UserEmailVerification::whereToken($token)->first();
        
        if (!$data) {
            return 0;
        }
        
        $userToVerify = $data->user;
        $message = '';
        
        if ($userToVerify->email == $data->email) 
        { 
            if ($userToVerify->email_verified) 
            {
                $message = 'Your email is already verified. Please login.';
            } 
            else
            {
                $userToVerify->email_verified = true;
                $userToVerify->email_verified_at = now();
                $userToVerify->updated_at = now();
                $userToVerify->update();
                
                $message = 'Thank you for verifying your email. Please login.';
            }
            
            return $message;
        }

    }
}