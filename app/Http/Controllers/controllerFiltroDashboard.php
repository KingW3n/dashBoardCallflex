<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controllerFiltroDashboard extends Controller
{
    public function index(Request $request, controllerRetornoDados $retorno)
    {
        $request->session()->put('categoria',$request->SelectFiltroEmpresa);
        $request->session()->put('filtroTempo',$request->SelectFiltrotempo);
        $request->session()->put('filtroMes',$request->SelectFiltroMes);
        $request->session()->put('filtroMesAno',$request->SelectFiltroMesAno);
        $request->session()->put('filtroAno',$request->SelectFiltroAno);
        $request->session()->put('filtrodataInicioBusca',date("Y-m-d", strtotime('-0 days', strtotime(implode('-', array_reverse(explode('/', $request->dataInicioBusca)))))));
        $request->session()->put('filtrodataFimBusca',date('Y-m-d', strtotime('+1 days', strtotime(implode('-', array_reverse(explode('/', $request->dataFimBusca)))))));
        switch ($request->SelectFiltrotempo) {
            case 'AL':
                return json_encode($retorno->AllCont($request->SelectFiltroEmpresa));
            break;
            case 'RH':
                return json_encode($retorno->LikeDateCont($request->SelectFiltroEmpresa,Date("Y-m-d")));
            break;
            case 'US':
                $data = date("Y-m-d", strtotime('-8 days', strtotime(date("Y-m-d"))));
                $data2 = date('Y-m-d', strtotime('+1 days', strtotime(date("Y-m-d"))));
                return json_encode($retorno->BetweenCont($request->SelectFiltroEmpresa,$data,$data2));
            break;
            case 'PM':
                $data = "".$request->SelectFiltroMesAno."-".$request->SelectFiltroMes;
                return json_encode($retorno->LikeDateCont($request->SelectFiltroEmpresa,$data));
            break;
            case 'PA':
                $data = $request->SelectFiltroAno;
                return json_encode($retorno->LikeDateCont($request->SelectFiltroEmpresa,$data));
            break;
            case 'PL':
                $data =  date("Y-m-d", strtotime('-0 days', strtotime(implode('-', array_reverse(explode('/', $request->dataInicioBusca))))));
                $data2 = date('Y-m-d', strtotime('+1 days', strtotime(implode('-', array_reverse(explode('/', $request->dataFimBusca))))));
                return json_encode($retorno->BetweenCont($request->SelectFiltroEmpresa,$data,$data2));
            break;

        }
    }
}
