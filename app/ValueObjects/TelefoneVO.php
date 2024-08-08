<?php

namespace App\ValueObjects;

use App\Models\Telefone;

class TelefoneVO {

    protected string $ddd;
    protected string $telefone; 

    /**
     * array associativo contendo "codigo" => "tipo"
     * @var array
     */
    protected array $tipo; 

    public function __construct(string $ddd, string $telefone, string $tipo) {
        $this->ddd = $ddd;
        $this->telefone = $telefone;
        $this->tipo = $tipo;
    }

    public function getDdd(): string
    {
        return $this->ddd;
    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }
    
    public function getTipo(): array
    {
        return $this->tipo;
    }

    public function setDdd(string $ddd): void
    {
        $this->ddd = $ddd;
    }

    public function setTelefone(string $telefone): void
    {
        $this->telefone = $telefone;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getJson(): array {
        return [
            'ddd' => $this->ddd,
            'telefone' => $this->telefone,
            'tipo' => $this->tipo,
        ];
    }

    public function getTelefoneFormatado(): string
    {
        return $this->ddd.$this->telefone;
    }
    
    public static function buildVO(Telefone $model): TelefoneVO
    {
        return new TelefoneVO($model->ddd, $model->telefone, $model->tipo_telefone);
    }

    public static function getTelefoneFormatadoFrom(Telefone $model): string
    {
        return $model->ddd.$model->telefone;
    }


}