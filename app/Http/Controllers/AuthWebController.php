<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthWebController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }
}

