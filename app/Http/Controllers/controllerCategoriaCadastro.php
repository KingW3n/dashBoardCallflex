<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class controllerCategoriaCadastro extends Controller
{
    public function index(Request $request, controllerBancoDados $banco)
    {
        if(!$request->session()->get('logado')){
            return redirect()->route('indexLogin');
        }
        return view('categorias.cadastro')->with('DadosUser', $banco->DadosUser($request->session()->get('email')));
    }

    public function salvar(Request $request, controllerBancoDados $banco)
    {
        $quantidade =  $banco->CategoriasVerifiqueCount($request->categoria);

        if($quantidade>0){
            $resposta['status'] = false;
            $resposta['mensagem'] = "Categoria ja existe em nossa base de dados.";
            return json_encode($resposta);
        }
        try{
            if($banco->InseiriCategoria($request->categoria)){
                $resposta['status'] = true;
                $resposta['mensagem'] = "Salvo com sucesso";
            }else{
                $resposta['status'] = false;
                $resposta['mensagem'] = "Error ao salvar, recarregue a pagina e tente novamente";
            }
        }catch(\Illuminate\Database\QueryException $ex){
            $resposta['status'] = false;
            $resposta['mensagem'] = "Error ao salvar, recarregue a pagina e tente novamente";
        }

        return json_encode($resposta);
    }
}
