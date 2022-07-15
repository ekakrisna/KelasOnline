<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Login endpoint
    public function login(Request $request)
    {
        $auth = new AuthService('admin');
        return $auth->login($request);
    }

    // Register endpoint
    public function register(Request $request)
    {
        $auth = new AuthService('admin');
        return $auth->register($request);
    }

    // Logout endpoint
    public function logout()
    {
        $auth = new AuthService('admin');
        return $auth->logout();
    }

    // Admin endpoint
    // Returns currently authenticated admin account
    public function account()
    {
        $auth = new AuthService('admin');
        return $auth->account();
    }
}
