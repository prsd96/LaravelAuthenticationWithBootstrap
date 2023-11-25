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

    public function sendPasswordResetLink(PasswordResetRequest $request)
    {
        (new PasswordResetService)->passwordResetEmail($request);
        return view('auth/password/password-reset-alert');
    }

    public function showPasswordResetForm($token)
    {
        $getEmail = PasswordReset::where(['token' => $token])->first();
        $email = $getEmail->email;
        return view('auth/password/password-reset-form', ['token' => $token, 'email' => $email]);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
       
        $updatePassword = (new PasswordResetService)->updateUserPassword($request);

        if($updatePassword)
        {
            return redirect()->route('login')->with(['type'=>'success', 'message' => $updatePassword]);
        }
        else
        {
            return view('error/user/user_unverified');
        }
        /*
        $request->validate([
            'email' => 'email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        
        $updatePassword = PasswordReset::where(['email' => $request->email, 'token' => $request->token])->first();
        
        if(!$updatePassword)
        {
            return back()->withInput()->with([
                'error' => 'Invalid token!',
                'alert_msg' => 'Invalid token!',
                'alert_type' => 'danger'
            ]);
        }
        
        $user = User::where('email', $request->email)
        ->update(['password' => Hash::make($request->password)]);
        
        PasswordReset::where(['email'=> $request->email])->delete();
        
        return redirect('/login')->with([
            'alert_msg' => 'Your password has been changed!',
            'alert_type' => 'success'
        ]);
        */
    }
}
