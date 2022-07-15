<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Login endpoint
    public function login(Request $request)
    {
        $auth = new AuthService('teacher');
        return $auth->login($request);
    }

    // Register endpoint
    public function register(Request $request)
    {
        $auth = new AuthService('teacher');
        return $auth->register($request);
    }

    // Logout endpoint
    public function logout()
    {
        $auth = new AuthService('teacher');
        return $auth->logout();
    }

    // Teacher endpoint
    // Returns currently authenticated teacher account
    public function account()
    {
        $auth = new AuthService('teacher');
        return $auth->account();
    }
}
