<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controllerGestaoUser extends Controller
{
    public function index(Request $request,controllerBancoDados $banco)
    {
        $dados = $banco->DadosUser($request->session()->get('email'));
        if($dados->perfil !="Admin"){
            return redirect()->route('home');
        }
        return view('gestaoDeUser.index')
        ->with('DadosUser', $banco->DadosUser($request->session()->get('email')))
        ->with('user',$banco->selectUsers());
    }

    public function removerAdminUser(Request $request,controllerBancoDados $banco)
    {
        if($banco->RemoverAdminUser($request->id)){
            $resposta['status'] = true;
            $resposta['mensagem'] = "Perfil de ADMIN removido com sucesso";
        }else{
            $resposta['status'] = false;
            $resposta['mensagem'] = "Erro ao remover o perfil de ADMIN ao Usuário";
        }

        return json_encode($resposta);
    }

    public function atribuirAdminUser(Request $request,controllerBancoDados $banco)
    {
        if($banco->AtribuirAdminUser($request->id)){
            $resposta['status'] = true;
            $resposta['mensagem'] = "Perfil de ADMIN atribuido com sucesso";
        }else{
            $resposta['status'] = false;
            $resposta['mensagem'] = "Erro ao atribuir o perfil de ADMIN ao Usuário";
        }

        return json_encode($resposta);
    }

    public function removerAcessoUser(Request $request,controllerBancoDados $banco)
    {
        if($banco->RemoverAcessoUser($request->id)){
            $resposta['status'] = true;
            $resposta['mensagem'] = "Acesso removido com sucesso";
        }else{
            $resposta['status'] = false;
            $resposta['mensagem'] = "Erro ao remover o acesso do Usuário";
        }

        return json_encode($resposta);
    }


}
