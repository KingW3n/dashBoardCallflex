<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controllerForgot extends Controller
{
    public function index(Request $request)
    {
        return view('forgot.index');
    }

    public function enterCode(Request $request)
    {
        return view('forgot.code');
    }

    public function NewSenha(Request $request)
    {
        return view('forgot.novaSenha');
    }
}
