<?php

namespace App\Http\Controllers\Auth;

use App\Services\User\UserService;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/registration/register');
    }
    
    public function verifyUserEmail($token, UserService $userService)
    {
        $emailVerify = $userService->verifyEmail($token);

        if($emailVerify)
        {
            return redirect()->route('login')->with(['type'=>'success', 'message' => $emailVerify]);
        }
        else
        {
            return view('error/user/user_unverified');
        }
    }
    
    public function login()
    {
        return view('auth/login');
    }
    
    public function checkUserLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) 
        {
            return redirect()->route('users.index');
        }
        else
        {
            return redirect()->route('login')->with([ 'type' => 'danger', 'message' => 'Oops! You have entered invalid credentials.']);
        }
    }
    
    public function logout() 
    {
        Session::flush();
        Auth::logout();
        
        return Redirect('/')->with([ 'type' => 'success', 'message' => 'You have been logged out.']);
    }
}
