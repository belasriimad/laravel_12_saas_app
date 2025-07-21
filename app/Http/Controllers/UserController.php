<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\RegisterUserRequest;

class UserController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegisterForm()
    {
        return view('users.register');
    }

    /**
     * Store new user
     */
    public function store(RegisterUserRequest $request)
    {
        User::create($request->validated());
        return to_route('login')->with('success','Account created successfully');
    }

    /**
     * Display the login form
     */
    public function showLoginForm()
    {
        return view('users.login');
    }

    /**
     * Login the user
     */
    public function login(AuthUserRequest $request)
    {
        $credentials = $request->validated();
        if(auth()->attempt($credentials)) {
            return to_route('qrcodes.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match any of our records.'
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
     * Display user profile
     */
    public function profile()
    {
        return view('users.profile');
    }
}
