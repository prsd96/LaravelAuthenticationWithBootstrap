<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\EmailVerificationMail;
use App\Models\UserEmailVerification;
use Illuminate\Support\Facades\Mail;

class UserService
{
    public function sendEmailVerification(User $user): void
    {
        $token = Str::random(64);

        UserEmailVerification::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'token' => $token,
        ]);

        $verificationURL = route('verifyUserEmail', $token);
        Mail::to($user->email)->send(new EmailVerificationMail($verificationURL));
    }

    public function verifyEmail($token)
    {
        $verification = UserEmailVerification::whereToken($token)->first();

        if (!$verification) 
        {
            return 0;
        }

        $user = $verification->user;
        $message = '';

        if ($user->email == $verification->email) 
        {
            if ($user->email_verified) 
            {
                $message = 'Your email is already verified. Please login.';
            } 
            else 
            {
                $user->email_verified = true;
                $user->email_verified_at = now();
                $user->save();

                $message = 'Thank you for verifying your email. Please login.';
            }

            return $message;
        }
    }
}
