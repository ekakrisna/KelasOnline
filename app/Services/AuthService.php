<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Class AuthService.
 */
class AuthService
{
    // The default authentication guard
    public $guard = 'user';

    public function __construct($guard)
    {
        $this->guard = $guard;
    }

    // Handle login
    public function login(Request $request)
    {
        // Default response
        $response = new \stdClass;
        $response->authenticated = false;

        // If the request specifies locale, set the app locale
        if (!empty($request->locale)) {
            App::setLocale($request->locale);
        }

        // Take only email and password
        $credentials = $request->only('email', 'password');

        // Validate the credentials
        $validator = Validator::make($credentials, [
            'email' => 'required',
            'password' => 'required',
        ]);

        // If validation fails
        if ($validator->fails()) {
            $errors = $validator->errors();
            $response->errors = $errors->toArray();
            $response->message = "Invalid email or password";
            return response()->json($response, 422);
        }

        // Remember me option
        $remember = $request->remember ?? false;

        // Do the login attempt, return 401 when unauthenticated
        $loginAttempt = Auth::guard($this->guard)->attempt($credentials, $remember);
        if (!$loginAttempt) {
            $response->message = "Invalid email or password";
            return response()->json($response, 422);
        }

        // Create token
        $user = auth($this->guard)->user();
        $response->token = $user->createToken('auth_token')->plainTextToken;
        $response->user = $user;
        $response->role = $this->guard;
        $response->message = "Login successful";

        // Default response on success
        $response->authenticated = true;
        return response()->json($response, 200);
    }

    // Handle register
    public function register(Request $request)
    {
        $response = new \stdClass;
        $response->authenticated = false;

        if ($this->guard == 'user') {
            $role = 'users';
            $user = new User();
        }
        if ($this->guard == 'teacher') {
            $role = 'teachers';
            $user = new Teacher();
        }
        if ($this->guard == 'admin') {
            $role = 'admins';
            $user = new Admin();
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . $role . '',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response->errors = $errors->toArray();
            $response->message = "Can't create new account";
            return response()->json($response, 422);
        }

        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ])->save();

        $response->token = $user->createToken('auth_token')->plainTextToken;
        $response->user = $user;
        $response->role = $this->guard;
        $response->authenticated = true;
        $response->message = "Register successful";

        return response()->json($response, 200);
    }

    // Handle logout
    public function logout()
    {
        $response = new \stdClass;
        $response->authenticated = false;
        $response->message = 'You have successfully logged out and the token was successfully deleted';
        $response->user = null;
        $response->role = null;

        $user = auth()->user();
        $token = $user->tokens()->delete();
        // $auth = Auth::guard($this->guard)->logout();
        $response->status = $token;

        return response()->json($response, 200);
    }

    // Handle account
    public function account()
    {
        $response = new \stdClass;
        // $user = auth($this->guard)->user();
        $user = auth('sanctum')->user();
        $response->user = $user;
        return response()->json($response, 200);
    }
}
