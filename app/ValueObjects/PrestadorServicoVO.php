<?php

namespace App\ValueObjects;

use App\Models\PrestadorServico;
use App\Services\PrestadorServicoService;

class PrestadorServicoVO {


      private int $id;
      private string $nome;
      private string $telefone;
      private ?string $cnpj;
      private ?string $cpf;
      private ?EnderecoVO $endereco;
      private array $tipos;
      private array $selectTipos; 
      private array $imobiliarias;

      public function __construct(int $id, string $nome, string $telefone, ?string $cnpj = null, 
            ?string $cpf = null, ?EnderecoVO $endereco = null, array $tipos, array $selectTipos, array $imobiliarias) {
            $this->id = $id;
            $this->nome = $nome;
            $this->telefone = $telefone;
            $this->cnpj = $cnpj;
            $this->cpf = $cpf;
            $this->endereco = $endereco;
            $this->tipos = $tipos;
            $this->selectTipos = $selectTipos;
            $this->imobiliarias = $imobiliarias;
      }

      public function getId(): int
      {
            return $this->id;
      }

      public function getNome(): string
      {
            return $this->nome;
      }

      public function getTelefone(): string
      {
            return $this->telefone;
      }

      public function getCnpj(): ?string
      {
            return $this->cnpj;
      }

      public function getCpf(): ?string
      {
            return $this->cpf;
      }

      public function getEndereco(): ?EnderecoVO
      {
            return $this->endereco;
      }

      public function getTipos(): array
      {
            return $this->tipos;
      }

      public function getSelectTipos(): array
      {
            return $this->selectTipos;
      }

      public function getImobiliarias(): array
      {
            return $this->imobiliarias;
      }

      public function setId(int $id): void
      {
            $this->id = $id;
      }

      public function setNome(string $nome): void
      {
            $this->nome = $nome;
      }

      public function setTelefone(string $telefone): void
      {
            $this->telefone = $telefone;
      }

      public function setCnpj(?string $cnpj): void
      {
            $this->cnpj = $cnpj;
      }

      public function setCpf(?string $cpf): void
      {
            $this->cpf = $cpf;
      }

      public function setEndereco(?EnderecoVO $endereco): void 
      {
            $this->endereco = $endereco;
      }

      public function setTipos(array $tipos): void 
      {
            $this->tipos = $tipos; 
      }

      public function setSelectTipos(array $selectTipos): void
      {
            $this->selectTipos = $selectTipos;
      }

      public function setImobiliarias(array $imobiliarias): void
      {
            $this->imobiliarias = $imobiliarias;
      }

      public function getJson()
      {
            return [
                  'nome' => $this->nome,
                  'telefone' => $this->telefone,
                  'cnpj' => $this->cnpj,
                  'cpf' => $this->cpf,
                  'tipos' => $this->tipos,
                  'endereco' => $this->endereco !== null ? $this->endereco->getJson() : null
            ];
      }

      public static function buildVO(PrestadorServico $model, array $tipos_prestadores){

            $tipos_servicos = $model->getRelation('tipo');
            $tipos = [];
            foreach ($tipos_servicos as $tipo) {
                  $tipo_vo = new SelectOptionVO($tipo->id, $tipo->tipo);
                  $tipos[] = $tipo_vo->getJson();
            }

            $telefone_relation = $model->getRelation('telefone');
            $telefone = TelefoneVO::getTelefoneFormatadoFrom($telefone_relation);
            

            $endereco_vo = $model->getRelation('endereco') !== null ? $endereco_vo = EnderecoVO::buildVO($model->getRelation('endereco')) : null;

            $imobiliarias = [];
            foreach ($model->getRelation('imobiliaria') as $imobiliaria) {
                  $imobiliarias[] = $imobiliaria->id;
            }


            return new PrestadorServicoVO(
                  $model->id,
                  $model->nome, 
                  $telefone, 
                  $model->cnpj, 
                  $model->cpf, 
                  $endereco_vo, 
                  $tipos,
                  $tipos_prestadores, 
                  $imobiliarias);
      }

}