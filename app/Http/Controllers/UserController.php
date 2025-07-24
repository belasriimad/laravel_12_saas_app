<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\AuthUserRequest;

class UserController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegistrationForm()
    {
        return view('users.register');
    }

    /**
     * Store the new user
     */
    public function store(AddUserRequest $request)
    {
        User::create($request->validated());
        return to_route('login')->with('success','Account created successfully.');
    }

    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('users.login');
    }

     /**
     * Log in the user
     */
    public function login(AuthUserRequest $request)
    {
        if(auth()->attempt($request->validated())) {
            return to_route('qrcodes.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
    }

    /**
     * Logout the user
     */
    public function logout()
    {
        auth()->logout();
        return to_route('login');
    }

    /**
     * Show the profile page
     */
    public function profile()
    {
        return view('users.profile');
    }
}
