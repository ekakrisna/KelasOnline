<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Login endpoint
    public function login(Request $request)
    {
        $auth = new AuthService('user');
        return $auth->login($request);
    }

    // Register endpoint
    public function register(Request $request)
    {
        $auth = new AuthService('user');
        return $auth->register($request);
    }

    // Logout endpoint
    public function logout()
    {
        $auth = new AuthService('user');
        return $auth->logout();
    }

    // User endpoint
    // Returns currently authenticated user account
    public function account()
    {
        $auth = new AuthService('user');
        return $auth->account();
    }
}
