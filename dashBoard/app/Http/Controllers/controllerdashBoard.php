<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controllerdashBoard extends Controller
{
    public function index()
    {
        return view('dashBoard.index');
    }
}
