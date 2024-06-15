<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Services\ImoveisService;
use Illuminate\Http\Request;
use App\Utils\CollectionUtils;
use App\Utils\SalasUtils;
use Illuminate\Support\Facades\DB;

class SalasController extends Controller
{

    
    public function cadastrar(Request $request, $idImovel){

        $titulo = 'Cadastrar sala';
        $imovel = ImoveisService::getImovelBy($idImovel);

        try {

            $inputs = $request->input();

            //input-sala-form-nome-1
            //input-sala-form-tipo-1

            $nome_salas = CollectionUtils::getAssociativeArray($inputs, '-' , 4, 'input-sala-form-nome-');
            $tipos_salas = CollectionUtils::getAssociativeArray($inputs, '-', 4, 'input-sala-form-tipo-');
            $salas_dto = SalasUtils::getSalasDTOsFromMerge($nome_salas, $tipos_salas, $imovel->id);

            DB::transaction(function($closure) use ($salas_dto){

                foreach ($salas_dto as $sala_dto) {

                    Sala::create([
                        'imovelcodigo' => $sala_dto->getIdImovel(),
                        'nomeSala' => $sala_dto->getNomeSala(),
                        'tipo_sala' => $sala_dto->getTipoSala(),
                    ]);
                }

            });


            return '<h1>CADASTRO CONCLUÍDO COM SUCESSO</h1>';

        } catch (\Throwable $th) {
            return redirect()->back()->with('erros', 'Não foi possível cadastrar o imóvel. '.$th->getMessage()); 
        }

        return '<h1>CADASTRO CONCLUÍDO COM SUCESSO</h1>';
    }

    /**
     * Esse método é usado apenas para o cadastro de salas após o cadastro do imóvel.
     * Ele é do método 'cadastrar' do ImoveisController quando o cadastro de um imóvel é realizado
     * com sucesso. 
     * 
     */
    public function cadastrarPrimeiraSala(Request $request, $idImovel, $mensagem){
        $imovel = ImoveisService::getImovelBy($idImovel);
        $titulo = 'Cadastrar as salas do imóvel :'.$imovel->nomefantasia;

        try {
            return view('app.cadastro-sala', compact('titulo', 'idImovel', 'imovel', 'mensagem'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('erros', $th->getMessage());
        }
        

    }

}
