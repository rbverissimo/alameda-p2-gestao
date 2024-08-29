<?php

namespace App\Models\BusinessObjects;

use App\Constants\Operacao;
use App\Http\Dto\ServicoDTO;
use App\Http\Dto\ServicoDTOBuilder;
use App\Services\ServicosTomadosService;
use App\Services\UsuarioService;
use App\Utils\CollectionUtils;
use App\Utils\ProjectUtils;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use SQLite3Exception;

class ServicosTomadosBO {


    private array $REGRAS_VALIDACAO_CADASTRO = [
        'codigo-servico' => 'unique:servicos,ud_codigo|required|max:9',
        'nome-servico' => 'unique:servicos,ud_nome|required|min:4|max:40',
        'data-fim' => 'required'      
    ];

    private array $REGRAS_VALIDACAO_EDICAO = [
        'codigo-servico' => 'required|max:9',
        'nome-servico' => 'required|min:4|max:40' 
    ];

    private array $MENSAGENS_VALIDACAO_CADASTRO = [
        'codigo-servico.unique' => 'O código não pode ser utilizado.',
        'nome-servico.unique' => 'O nome não pode ser utilizado.',
        
        'data-fim.required' => 'A data do término deve ser preenchida'
    ];

    private array $MENSAGENS_VALIDACAO_EDICAO = [
        
        'required' => 'O :attribute deve ser preenchido'
    ];
    
    
    public function getRegrasValidacao($operacao = 'cadastrar'){
        if($operacao === 'cadastrar'){
            return $this->REGRAS_VALIDACAO_CADASTRO;
        } else if($operacao === 'editar') {
            return $this->REGRAS_VALIDACAO_EDICAO;
        } else {
            throw new InvalidArgumentException("Regras de validação não especificadas corretamente. ");
        }
    }

    public function getMensagensValidacao($operacao = 'cadastrar'){
        if($operacao === 'cadastrar'){
            return $this->MENSAGENS_VALIDACAO_CADASTRO;
        } else if($operacao === 'editar') {
            return $this->MENSAGENS_VALIDACAO_EDICAO;
        } else {
            throw new InvalidArgumentException("Mensagens de validação não especificadas corretamente. ");
        }
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
        if(count($prestadores_nao_validados) < 1){
            throw new InvalidArgumentException("É necessário declarar ao menos um prestador de serviço para o serviço tomado.");
        }

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

    public function deletarServico($idServico): bool
    {
        $deletado = false;
        $notas = ServicosTomadosService::getNotas($idServico);
        if(count($notas->toArray()) > 0){
            throw new InvalidArgumentException('O serviço possui notas cadastradas. 
                É necessário excluir essas notas antes de excluir o serviço dos registros.');
        }

        $sql = 'DELETE FROM PRESTADORES_SERVICOS_PRESTADOS WHERE IDSERVICO = ?';
        $bindings = [$idServico];

        $deletado = DB::transaction(function() use ($sql, $bindings, $idServico){

            $servico_old = ServicosTomadosService::getServicosBy($idServico);

            $registros_deletados = DB::delete($sql, $bindings);
            if(!$registros_deletados > -1){
                throw new SQLite3Exception('Erro ao processar a requisição de excluir os prestadores dos serviços');
            }

            if(!$servico_old->delete()){
                throw new Exception('Não foi possível excluir o registro do serviço tomado');
            };

            return true;
        });

        return $deletado;
    }
}