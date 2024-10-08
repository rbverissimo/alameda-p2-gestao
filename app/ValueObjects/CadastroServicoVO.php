<?php

namespace App\ValueObjects;

use App\Models\Servico;
use App\Services\ImobiliariasService;
use App\Services\ImoveisService;

class CadastroServicoVO { 

    private int $id;
    private string $codigo;
    private string $nome;
    private string $imobiliaria;
    private array $imobiliarias_select; 
    private string $imovel;
    private array $imoveis_select;
    private string $sala;
    private array $salas_select;
    private string $dataInicio;
    private ?string $dataFim;
    private float $valor;
    private string $tipo;
    private ?string $descricao; 
    private array $prestadores;

    public function __construct(int $id, string $codigo, string $nome, string $imobiliaria, array $imobiliarias_select, string $imovel, array $imoveis_select, string $sala, 
        array $salas_select, string $dataInicio, float $valor, string $tipo, array $prestadores, ?string $dataFim = null, ?string $descricao = null) {
        
        $this->id = $id;
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->imobiliaria = $imobiliaria;    
        $this->imobiliarias_select = $imobiliarias_select;
        $this->imovel = $imovel;
        $this->imoveis_select = $imoveis_select;
        $this->sala = $sala;
        $this->salas_select = $salas_select;
        $this->dataInicio = $dataInicio;
        $this->valor = $valor;
        $this->tipo = $tipo;
        $this->prestadores = $prestadores;
        $this->dataFim = $dataFim;
        $this->descricao = $descricao;
    }

    // Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getImobiliaria(): string
    {
        return $this->imobiliaria;
    }

    public function getImobiliariasSelect(): array
    {
        return $this->imobiliarias_select;
    }

    public function getImovel(): string
    {
        return $this->imovel;
    }

    public function getImoveisSelect(): array
    {
        return $this->imoveis_select;
    }

    public function getSala(): string
    {
        return $this->sala;
    }

    public function getSalasSelect(): array
    {
        return $this->salas_select;
    }

    public function getDataInicio(): string
    {
        return $this->dataInicio;
    }

    public function getDataFim(): ?string
    {
        return $this->dataFim;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function getPrestadores(): array
    {
        return $this->prestadores;
    }

    // Setters
    public function setId(int $id): void
    {
        $this->id = $id;
    } 
    
    public function setCodigo(string $codigo): void
    {
        $this->codigo = $codigo;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setImobiliaria(string $imobiliaria): void
    {
        $this->imobiliaria = $imobiliaria;
    }

    public function setImobiliariasSelect(array $imobiliarias_select): void
    {
        $this->imobiliarias_select = $imobiliarias_select;
    }

    public function setImovel(string $imovel): void
    {
        $this->imovel = $imovel;
    }

    public function setImoveisSelect(array $imoveis_select): void
    {
        $this->imoveis_select = $imoveis_select;
    }

    public function setSala(string $sala): void
    {
        $this->sala = $sala;
    }

    public function setSalasSelect(array $salas_select): void
    {
        $this->salas_select = $salas_select;
    }

    public function setDataInicio(string $dataInicio): void
    {
        $this->dataInicio = $dataInicio;
    }

    public function setDataFim(?string $dataFim): void
    {
        $this->dataFim = $dataFim;
    }

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function setDescricao(?string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function setPrestadores(array $prestadores): void
    {
        $this->prestadores = $prestadores;
    }
    
    public static function buildVO(Servico $model){
        $prestadoresModels = $model->getRelation('prestadores');
        $prestadores = [];
        foreach ($prestadoresModels as $prestador) {
            $prestadores[] = [
                'nome' => $prestador->nome
            ];
        }
        $imobiliarias = ImobiliariasService::getListaImobiliariasSelect();
        $imovel = ImoveisService::getImovelModelBy($model->salacodigo);
        $imoveis = ImoveisService::getListaSelectImoveisBy($imovel->imobiliaria_id);
        $salas = ImoveisService::getListaSalaSelectBy($imovel->id);

        return new CadastroServicoVO(
            $model->id,
            $model->ud_codigo,
            $model->ud_nome,
            $imovel->imobiliaria_id,
            $imobiliarias,
            $imovel->id,
            $imoveis,
            $model->salacodigo,
            $salas,
            $model->dataInicio,
            $model->valor,
            $model->tipo_servico,
            $prestadores,
            $model->dataFim,
            $model->descricao
        );
    }
}