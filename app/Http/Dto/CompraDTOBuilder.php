<?php

namespace App\Http\Dto;

class CompraDTOBuilder {

    private  CompraDTO $compra_dto;

    public function __construct() {
        $this->compra_dto = new CompraDTO();
    }

    

}