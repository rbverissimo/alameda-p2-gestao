<?php

namespace App\Models\BusinessObjects;

use App\Services\NotasFiscaisServicosService;
use Illuminate\Support\Facades\DB;

class NotasFiscaisServicosBO {



    public function deletarNota($id): bool
    {
        return DB::transaction(function () use($id) {
            return NotasFiscaisServicosService::getNfse($id)->delete();
            
        });;
    }
    
}