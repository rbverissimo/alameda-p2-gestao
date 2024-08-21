<?php

namespace App\Http\Dto;

use App\Utils\ProjectUtils;

class TelefoneDTOBuilder {

    private TelefoneDTO $telefone_dto;

    public function __construct() {
        $this->telefone_dto = new TelefoneDTO();
    }

    public function withDdd(string $ddd): TelefoneDTOBuilder
    {
        $this->telefone_dto->setDdd($ddd);
        return $this;
    }

    public function withTelefone(string $telefone): TelefoneDTOBuilder
    {
        $this->telefone_dto->setTelefone($telefone);
        return $this;
    }

    public function withTipo(int $tipo): TelefoneDTOBuilder
    {
        $this->telefone_dto->setTipo($tipo);
        return $this;
    }

    public function build(): TelefoneDTO
    {
        return $this->telefone_dto;
    }

    public static function getDto($arr): array 
    {
        $resultado = [];
        foreach ($arr as $dataEl) {
            $telefone_limpo = ProjectUtils::tirarMascara($dataEl["telefone"]);
            $ddd = substr($telefone_limpo, 0, 2);
            $telefone = substr($telefone_limpo, 2);
            $tipo = $dataEl["tipo"];
    
            $dto = (new TelefoneDTOBuilder)
                ->withDdd($ddd)
                ->withTelefone($telefone)
                ->withTipo($tipo)
            ->build();
            $resultado[] = $dto;
        }
        return $resultado;
    }
}