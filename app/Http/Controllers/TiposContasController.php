<?php

namespace App\Http\Controllers;

use App\Models\TipoConta;
use App\Services\ImoveisService;
use App\Services\TipoContasService;
use Illuminate\Http\Request;

class TiposContasController extends Controller {


    public function cadastrarPrimeirasContas(Request $request, $idImovel, $mensagem){

        $titulo = 'Cadastro dos tipos de contas do imóvel';

        try {

            $imovel = ImoveisService::getImovelWithSalasBy($idImovel);

            if($imovel){
                $endereco_cadastrado = $imovel->getRelation('endereco');
                $imovel_cadastrado = [];
                $salas_cadastradas = [];
                if($endereco_cadastrado){
                    
                    $endereco_string = sprintf(
                        '%s %d, %s. CEP: %s, %s-%s',
                        $endereco_cadastrado->logradouro,
                        $endereco_cadastrado->numero,
                        $endereco_cadastrado->bairro,
                        $endereco_cadastrado->cep,
                        $endereco_cadastrado->cidade,
                        $endereco_cadastrado->uf
                    );
                        
                    $imovel_cadastrado = [
                        'nomefantasia' => $imovel->nomefantasia,
                        'endereco' => $endereco_string,
                    ];
                    
                }

                if($imovel->sala){
                    $salas_cadastradas = $imovel->sala->map(function($sala){
                        $descricao_tipoSala = $sala->tipo_sala ? ImoveisService::getTipoSalaBy($sala->tipo_sala) : null;
                        return [
                            'descricao' => $sala->nomesala,
                            'tipo' => $descricao_tipoSala,
                        ];
                    });
                }

                dd($salas_cadastradas);
            }

            /*
                Ao cadastrar o imóvel pela primeira, as únicas contas que serão disponibilizadas 
                como chip para o usuário selecionar serão aquelas que estão registradas por padrão no 
                sistema.
            */
            $chips = TipoContasService::getTiposContasDoSistema()->map(function($tipoConta){
                return [
                    'id' => 'chip-' + $tipoConta->id,
                    'text' => $tipoConta->descricao,
                    'value' => $tipoConta->id,
                ];
            }); 

            return view('app.cadastro-tipo-contas-imovel', compact('titulo', 'chips', 'imovel_cadastrado', 'salas_cadastradas', 'mensagem'));

        } catch (\Throwable $th) {
            return redirect()->back()->with('erros', 'Não foi possível cadastrar os tipos de conta do imóvel. ' + $th->getMessage());
        }

    }

}