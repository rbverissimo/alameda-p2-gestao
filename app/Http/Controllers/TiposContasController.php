<?php

namespace App\Http\Controllers;

use App\Models\TipoConta;
use App\Services\ImoveisService;
use Illuminate\Http\Request;

class TiposContasController extends Controller {


    public function cadastrarPrimeirasContas(Request $request, $idImovel){

        $titulo = 'Cadastro dos tipos de contas do imóvel';

        try {

            $imovel = ImoveisService::getImovelWithSalasBy($idImovel);

            if($imovel){
                $endereco_cadastrado = $imovel->endereco;
                $imovel_cadastrado = [];
                if($endereco_cadastrado){
                    
                    $endereco_string = sprintf(
                        '%s %s, %s. CEP: %s, %s-%s',
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

                $salas_cadastradas = [];
                if($imovel->sala){
                    foreach ($imovel->sala as $sala) {
                        $descricao_tipoSala = '';
                        if($sala->tipo_sala){
                            $descricao_tipoSala = ImoveisService::getTipoSalaBy($sala->tipo_sala);
                        }

                        $sala_cadastrada = [
                            'descricao' => $sala->nomesala,
                            'tipo' => $descricao_tipoSala,
                        ];

                        $salas_cadastradas = $sala_cadastrada;
                    }
                }
            }

            /*
                Ao cadastrar o imóvel pela primeira, as únicas contas que serão disponibilizadas 
                como chip para o usuário selecionar serão aquelas que estão registradas por padrão no 
                sistema.
            */
            $chips = TipoConta::all()->map(function($tipoConta){
                return [
                    'id' => 'chip-' + $tipoConta->id,
                    'text' => $tipoConta->descricao,
                    'value' => $tipoConta->id,
                ];
            }); 

            return view('app.cadastro-tipo-contas-imovel', compact('titulo', 'chips', 'imovel_cadastrado', 'salas_cadastradas'));

        } catch (\Throwable $th) {
            return redirect()->back()->with('erros', 'Não foi possível cadastrar os tipos de conta do imóvel. ' + $th->getMessage());
        }

    }

}