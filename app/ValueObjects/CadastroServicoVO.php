<?php

namespace App\ValueObjects;

class CadastroServicoVO { 

    private string $codigo;
    private string $nome;
    private int $imobiliaria;
    private array $imobiliarias_select; 
    private int $imovel;
    private array $imoveis_select;
    private int $sala;
    private array $salas_select;
    private string $dataInicio;
    private string $dataFim;
    private float $valor;
    private int $tipo;
    private string $descricao; 
    private array $prestadores; 
    
}