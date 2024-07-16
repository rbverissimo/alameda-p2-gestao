<?php

namespace App\Http\Controllers;

use App\Models\TipoConta;
use App\Services\ImoveisService;
use App\Services\TipoContasService;
use App\Utils\CollectionUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TiposContasController extends Controller {


    public function cadastrar(Request $request, $idImovel){


        try {
            //input-tipo-conta-form-1
            $inputs = $request->input();

            $id_tipos_contas = CollectionUtils::getAssociativeArray($inputs, '-', 4, 'input-tipo-conta-form-');

            $imoveis_tipos_contas_dto = [];
            foreach ($id_tipos_contas as $key => $value) {
                $dto = [
                    'imovel' => $idImovel,
                    'tipoconta' => $value
                ];
                $imoveis_tipos_contas_dto[] = $dto; 
            }

            $table_name = 'imoveis_tipos_contas';

            DB::table($table_name)->insert($imoveis_tipos_contas_dto);

            $mensagem = [
                'status' => 'sucesso',
                'mensagem' => 'Tipos de contas definidos! Imóvel cadastrado com sucesso!',
            ];

            $imoveis_controller = new ImoveisController();
            return $imoveis_controller->index($mensagem);

        } catch (\Throwable $th) {
            return redirect()->back()->with('erros', 'Não foi possível cadastrar os tipos de conta do imóvel. ' + $th->getMessage());
        }

    }


    public function cadastrarPrimeirasContas(Request $request, $idImovel, $mensagem){

        $titulo = 'Cadastro dos tipos de contas do imóvel';

        try {

            $imovel = ImoveisService::getImovelWithSalasBy($idImovel);

            if($imovel){
                $endereco_cadastrado = $imovel->getRelation('endereco');
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

                if($imovel->relationLoaded('sala')){
                    $salas_cadastradas = $imovel->getRelation('sala')->map(function($sala){
                        $descricao_tipoSala = $sala->tipo_sala ? 
                            ImoveisService::getTipoSalaBy($sala->tipo_sala) 
                            : 'Tipo de sala não identificado';
                        return [
                            'descricao' => $sala->nomesala,
                            'tipo' => $descricao_tipoSala,
                        ];
                    });
                }

            }

            /*
                Ao cadastrar o imóvel pela primeira, as únicas contas que serão disponibilizadas 
                como chip para o usuário selecionar serão aquelas que estão registradas por padrão no 
                sistema.
            */
            $chips = TipoContasService::getTiposContasDoSistema()->map(function($tipoConta){
                return [
                    'id' => 'chip-'.$tipoConta->id,
                    'text' => $tipoConta->descricao,
                    'value' => $tipoConta->id,
                    'name' => 'input-tipo-conta-form-'.$tipoConta->id,
                ];
            }); 

            return view('app.cadastro-tipo-contas-imovel', compact('titulo', 'chips', 'idImovel', 'imovel_cadastrado', 'salas_cadastradas', 'mensagem'));

        } catch (\Throwable $th) {
            return redirect()->back()->with('erros', 'Não foi possível cadastrar os tipos de conta do imóvel. ' + $th->getMessage());
        }

    }

    public function listarPorSala($idImovel){

        $tipos_contas = TipoContasService::getDescricaoTipoContaBy($idImovel);
        foreach ($tipos_contas as $tipo) {
            $tipo->view = $tipo->descricao;
        }
        return $tipos_contas;

    }

}