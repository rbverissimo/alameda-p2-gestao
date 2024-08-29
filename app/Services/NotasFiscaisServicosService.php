<?php

namespace App\Services;

use App\Models\NotalFiscalServico;

class NotasFiscaisServicosService {


    public static function getNfse($id): NotalFiscalServico
    {
        return NotalFiscalServico::with('servico')->find($id);
    }
    
}