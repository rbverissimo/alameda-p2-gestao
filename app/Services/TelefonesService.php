<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class TelefonesService {


    public static function getTipos(){
        return DB::table('tipos_telefones')
            ->select('codigo','tipo')
            ->get();
    }
}