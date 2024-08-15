<?php

namespace App\Services;

use App\Models\ContaImovel;
use App\Models\Imovel;
use App\Models\InquilinoConta;
use App\Models\Sala;
use App\Models\TipoSala;
use App\Models\UsuarioImovel;
use App\ValueObjects\SelectOptionVO;

class ImoveisService {
    
    /**
     * Retorna dos imóveis ligados àquele usuário logado
     */
    public static function getImoveisByUsuarioLogado(){
        $user = UsuarioService::getUsuarioLogado();
        $usuario_imoveis = UsuarioImovel::select('idImovel')
        ->where('idUsuario', $user)
        ->groupBy('idImovel')
        ->get();
        return $usuario_imoveis->pluck('idImovel')->toArray();
    }

    /**
     * Esse método retorna o ID máximo da tabela de imóveis
     * 
     * @return int
     */
    public static function getIDMaximo(){
        return Imovel::max('id');
    }

    /**
     * Esse método busca o imóvel junto de seu endereço no banco
     * de dados de acordo com ID passado no parâmetro
     * @return App\Models\Imovel
     */
    public static function getImovelBy($idImovel){
        return Imovel::with('endereco')->where('id',$idImovel)->first();
    }


    /**
     * Esse método busca o imóvel junto de seu endereço e suas salas
     * relacionadas ao mesmo no banco de dados de acordo com o ID passado
     * no parâmetro da assinatura do método
     * 
     * @return App\Models\Imovel
     */
    public static function getImovelWithSalasBy($idImovel){
        return Imovel::with('endereco')->with('sala')->find($idImovel);
    }

    /**
     * Esse método retorna uma lista de imóveis de acordo
     * com o usuário logado no sistema
     * @return array 
     */
    public static function getImoveis(){
        $usuarioLogado = UsuarioService::getUsuarioLogado();
        $imoveis_usuario = UsuarioImovel::with('imoveis')
            ->where('idUsuario', $usuarioLogado)
            ->orderBy('idImovel', 'desc')
            ->get();

        $imoveis = [];

        foreach ($imoveis_usuario as $imovel_usuario) {
            if ($imovel_usuario->has('imoveis')) {
              $imoveis[] = $imovel_usuario->imoveis;
            }
        }

        return $imoveis;
    }

    /**
     * Esse método retorna uma lista dos pares ID, nomefantasia
     * dos imóveis cadastrados em um usuário com um registro vazio no primeiro resultado.
     * O intuito desse método é criar os campos select no front-end de forma correta
     */
    public static function getListaImoveisSelect(){
        $imoveis = Imovel::select('imoveis.id', 'imoveis.nomefantasia')
            ->whereIn('imoveis.id', ImoveisService::getImoveisByUsuarioLogado())
            ->get();
        $options = [SelectOptionVO::getPrimeiroElementoVazio()];
        foreach ($imoveis as $imovel) {
            $option = new SelectOptionVO($imovel->id, $imovel->nomefantasia);
            $options[] = $option->getJson();
        }
        return array_merge($options);

    }

    public static function getListaSelectImoveisBy($imobiliaria){
        $imoveis = ImobiliariasService::getImoveisBy($imobiliaria);
        $options = [SelectOptionVO::getPrimeiroElementoVazio()];
        foreach ($imoveis as $imovel) {
            $option = new SelectOptionVO($imovel->id, $imovel->nomefantasia);
            $options[] = $option->getJson();
        }
        return array_merge($options);
    }

    /**
     * Esse método retorna as salas cadastradas ao um imóvel específico
     * 
     * @return Illuminate\Database\Eloquent\Collection 
     */
    public static function getSalaBy($imovel){
        return Sala::where('imovelcodigo', $imovel)->get();
    }

    /**
     * Esse método busca os tipos de contas associados a um imóvel
     * no banco de dados. Se ele encontrar, ele retorna um array
     * com os tipos. Caso contrário, ele retorna um array vazio. 
     * 
     * @return array de App\Models\TipoConta
     */
    public static function getTipoContasBy($imovel){
        $imovel = Imovel::with('tipos_contas')->where('id', $imovel)->first();

        return $imovel->tipos_contas ?? [];
    }

    /**
     * Esse método busca as informações de uma sala junto
     * ao imóvel ao qual está associada
     * 
     * @return App\Models\Sala
     */
    public static function getSalaImovelBy($sala){
        return Sala::with('inquilino')->where('id', $sala)->first();
    }

    /**
     * Esse método busca um registro de tipo de sala apenas com a descrição 
     * no objeto de retorno. 
     * 
     * @return App\Models\TipoSala
     */
    public static function getTipoSalaBy($idTipoSala){
        return TipoSala::where('id', $idTipoSala)->pluck('descricao')->first();
    }

    public static function podeSalvarNoImovel($idImovel) {
        $usuario = UsuarioService::getUsuarioLogado();
        $imoveis_usuario = UsuarioService::getImoveisBy($usuario);
        return in_array($idImovel, $imoveis_usuario);
    }

    /**
     * Busca o ID do imóvel o qual a sala passada 
     * através do parâmetro possui uma relação.
     * 
     * @return int
     */
    public static function getImovelBySala($sala){
        return Sala::where('id', $sala)->pluck('imovelcodigo')->first();
    }

    /**
     * Dado um inquilino, fornecido no parâmetro, esse método retorna
     * o ID do imóvel em que esse inquilino está
     */
    public static function getImovelByInquilino($inquilino): int
    {
       $sala = InquilinosService::getInquilinoBy($inquilino)->salacodigo;
       return ImoveisService::getImovelBySala($sala);
    }

    /**
     * Esse método busca uma conta de acordo com seu imóvel e uma referências
     * ambos passados no parâmetro do imóvel
     */
    public static function getContasAnoMes($ano, $mes, $idImovel){
        return ContaImovel::whereHas('sala', function($query) use ($idImovel){
            $query->where('imovelcodigo', $idImovel);
        })->where([
            ['ano', $ano],
            ['mes', $mes]
        ])->get();
    }

    /**
     * Esse método busca uma conta imóvel composta pelo seu tipo de conta 
     * a partir do seu ID passado pelo parâmetro.
     */
    public static function getContasImovelById($idContaImovel){
        return ContaImovel::with('tipo_conta')->where('id', $idContaImovel)->first();
    }

    /**
     * Esse método busca apenas o valor de uma conta do imóvel de acordo
     * com o ID da conta passado no parâmetro
     * 
     * @return float
     */
    public static function getContaImovelValorById($idConta): float
    {
        return ContaImovel::where('id', $idConta)->pluck('valor')->first();
    }

    public static function getSomaContasInquilinoByContaImovelExceto($conta_imovel, $idConta): float
    {
        return InquilinoConta::where('contacodigo', $conta_imovel)
            ->whereRaw('id <> ?', $idConta)
            ->sum('valorinquilino');
    }

}