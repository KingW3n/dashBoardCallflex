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

    public function enviarCode(Request $request,controllerRetornoDados $retornoDados)
    {
        $dadosUser = $retornoDados->DadosUser($request->email);
        if($dadosUser != null){
            //Gera o codigo randomico para verificação do e-mail
            $Codigo = $this->generateRandomString(6);
            //Criar o array de objetos para enviar no e-mail
            $data = ['code' => $Codigo,'nome'=>$dadosUser->nome,'email'=>$request->email];
            //armazena os dados para envio do email
            $email = $request->email;
            Mail::send('mail.code',$data, function ($message) use ($email,$dadosUser) {
                $message->from('wendel.junior@callflex.net.br', 'Callflex Dashboard');
                $message->to($email, $dadosUser->nome);
                $message->subject('codigo de verificação');
            });
            $request->session()->put('Codigo',$Codigo);
            $resposta['email'] = true;
            $resposta['mensagem'] = "enviado";

            return json_encode($resposta);
        }else{
            $resposta['email'] = false;
            $resposta['mensagem'] = "E-mail não localizado na base de usuarios do Plugin";

            return json_encode($resposta);
        }

    }

    public function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
