<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthInfoController extends Controller
{
    public $status = false;
    public $guard;
    public $username = '';
    public $role = '';
    public $error = '';

    public function __construct($guard = '')
    {
        $this->guard = $guard;
    }

    public function setAuthenticated($username, $guard = '', $role = '')
    {
        $this->status = true;
        $this->username = $username;
        $this->guard = $guard;
        $this->role = $role;
        return $this;
    }

    public function invalidate()
    {
        $this->status = false;
        $this->username = '';
        $this->role = '';
        $this->error = '';
        return $this;
    }

    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }
}
