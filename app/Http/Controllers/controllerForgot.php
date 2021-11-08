<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class controllerForgot extends Controller
{
    public function index(Request $request)
    {
        return view('forgot.index');
    }

    public function enviarCode(Request $request)
    {
        $data = ['code' => 'baz','email'=>$request->email];
        $email = $request->email;
        Mail::send('mail.code',$data, function ($message) use ($email) {
            $message->from('wendel.junior@callflex.net.br', 'Callflex Dashboard');
            $message->to($email, 'junior');
            $message->subject('codigo de verificação');
        });

      return redirect(route('enterCode'));
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
