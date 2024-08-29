<?php 

namespace App\Models\BusinessObjects;

use App\Services\PrestadorServicoService;
use App\ValueObjects\AppDataVO;
use App\ValueObjects\SelectOptionVO;

class PrestadorServicoBO {

    public function getAppData(){
        try {
            $tipos_prestador_lista = PrestadorServicoService::getListaTiposPrestadores();

            $tipos_prestador = [];
            foreach ($tipos_prestador_lista as $tipo) {
                $select = new SelectOptionVO($tipo->id, $tipo->tipo);
                $tipos_prestador[] = $select->getJson();
            }


            $appData_vo = new AppDataVO('dados_prestador_servico', [
                'tipos_prestador' => array_merge($tipos_prestador)
            ]);

        return $appData_vo->getJson();
        } catch (\Throwable $th) {
            
            throw $th;
        }  
    }
}