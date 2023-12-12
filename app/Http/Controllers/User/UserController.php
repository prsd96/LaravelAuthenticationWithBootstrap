<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\{CreateUserRequest, UpdateUserRequest};

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('user/index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUserRequest  $request
     * @return \Illuminate\View\View
     */
    public function store(CreateUserRequest $request, UserService $userService)
    {
        $user = User::create($request->validated());

        // Send email verification email
        $userService->sendEmailVerification($user);

        return view('auth/registration/verify_email_alert');
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        // You might want to update this method based on your requirements
        return view('user/show', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest  $request
     * @param  User  $user
     * @return \Illuminate\View\View
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return view('user/show', compact('user'))->with(['success' => 'User updated successfully']);
    }
}
