<?php

namespace App\Http\Controllers;

use App\Models\ContaImovel;
use App\Models\Imovel;
use App\Services\UsuarioService;
use Illuminate\Http\Request;

class ImoveisController extends Controller
{

    public function index(){

        $titulo = 'Lista de Imóveis';
        $idUsuario = UsuarioService::getUsuarioLogado();

        $imoveis = Imovel::select('imoveis.id', 'imoveis.nomefantasia', 
            'enderecos.logradouro', 'enderecos.bairro', 'enderecos.numero', 'enderecos.cep', 'enderecos.cidade')
            ->join('enderecos', 'enderecos.id', 'imoveis.endereco')
            ->join('users_imoveis', 'users_imoveis.idImovel', 'imoveis.id')
            ->where('users_imoveis.idUsuario', $idUsuario)
            ->get();

        return view('app.imoveis', compact('titulo', 'imoveis'));
    }

    public function detalharImovel($imovel){
        $imovel = Imovel::where('id', $imovel)->first();
        $titulo = 'Painel do Imóvel: '.$imovel->nomefantasia; 
        $id = $imovel->id;

        return view('app.painel-imovel', compact('titulo', 'id')); 
    }

    public function listarContas($idImovel){

        $contas_imovel = ContaImovel::select('contas_imoveis.id', 'contas_imoveis.valor', 'contas_imoveis.tipocodigo','contas_imoveis.ano', 'contas_imoveis.mes')
            ->join('salas', 'salas.imovelcodigo', 'contas_imoveis.imovelcodigo')
            ->where('contas_imoveis.imovelcodigo', $idImovel)
            ->where('salas.imovelcodigo', $idImovel)
            ->orderBy('contas_imoveis.id', 'desc')
            ->groupBy('contas_imoveis.id', 'contas_imoveis.valor', 'contas_imoveis.tipocodigo', 'contas_imoveis.ano', 'contas_imoveis.mes')
            ->paginate(15); 

        return $contas_imovel;
    }

    public function executarCalculoContas($idImovel, $periodoReferencia = null){

        $titulo = 'Executar cálculo de contas do imóvel';

        return view('app.painel-calcular-contas', compact('titulo'));

    }
}
