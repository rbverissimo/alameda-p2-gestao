<?php

namespace App\Models\BusinessObjects;

use App\Constants\Operacao;
use App\Http\Dto\ServicoDTO;
use App\Http\Dto\ServicoDTOBuilder;
use App\Services\ServicosTomadosService;
use App\Services\UsuarioService;
use App\Utils\CollectionUtils;
use App\Utils\ProjectUtils;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ServicosTomadosBO {


    private array $REGRAS_VALIDACAO = [
        'ud_codigo' => 'unique:servicos',
        'ud_nome' => 'unique:servicos'
    ];
    
    public function getRegrasValidacao(){
        return $this->REGRAS_VALIDACAO;
    }

    public function getDto($inputs, $idServico): ServicoDTO
    {
        try {

            $prestadores_atualizar = array_values(CollectionUtils::getAssociativeArray($inputs, '-', 2, 'prestador-servico'));
            $this->validarPrestadores($prestadores_atualizar);

            $old_model = $this->getServicoBy($idServico);

            $excluirAdicionar = CollectionUtils::getValoresAdicionarExcluir(
                array_map(function($prestador){
                    return $prestador['nome'];
                }, 
                    $old_model->getRelation('prestadores')->toArray()), 
                array_values(CollectionUtils::getAssociativeArray($inputs, '-', 2, 'prestador-servico'))
            );

            $prestadores_excluir = $excluirAdicionar['excluir'];
            $prestadores_adicionar = $excluirAdicionar['adicionar'];

            $codigoServico = $inputs['codigo-servico'];
            $nomeServico = $inputs['nome-servico']; 
            $sala = $inputs['sala-select'];
            $dataInicio = ProjectUtils::normalizarData($inputs['data-inicio'], Operacao::SALVAR);
            $dataFim = ProjectUtils::normalizarData($inputs['data-fim'], Operacao::SALVAR);
            $valorServico = ProjectUtils::retirarMascaraMoeda($inputs['valor-servico']);
            $tipoServico = $inputs['tipo-servico'];
            $descricaoServico = $inputs['descricao-servico'];


            $servico_dto = (new ServicoDTOBuilder)
                ->withCodigo($codigoServico)
                ->withNome($nomeServico)
                ->withSala($sala)
                ->withDataInicio($dataInicio)
                ->withDataFim($dataFim)
                ->withValor($valorServico)
                ->withTipo($tipoServico)
                ->withDescricao($descricaoServico)
                ->withPrestadores($prestadores_adicionar)
                ->withPrestadoresExcluir($prestadores_excluir)
            ->build();

            return $servico_dto;
        } catch (\Throwable | ValidationException $th) {
            throw $th;
        }
    }

    /**
     * Este método recebe uma lista de prestadores e valida a existência deles no banco de dados.
     */
    private function validarPrestadores($prestadores_nao_validados): void
    {
        $regras = [];
        foreach ($prestadores_nao_validados as $key => $value) {
            $regras[$key] = 'exists:prestadores_servicos,nome';
            $validator = Validator::make($prestadores_nao_validados, $regras);
        }

        if($validator->fails()){
            throw new ValidationException($validator);
        }
    }

    public function getPainelServicosLista(){
        $imobiliarias = UsuarioService::getImobiliarias();
        return ServicosTomadosService::getPainelListaServicos($imobiliarias);
    }

    public function getServicoBy($idServico){
        return ServicosTomadosService::getServicosBy($idServico);
    }
}