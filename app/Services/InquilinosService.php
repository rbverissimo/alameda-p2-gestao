<?php

namespace App\Services;

use App\Models\Comprovante;
use App\Models\Contrato;
use App\Models\Inquilino;
use App\Models\InquilinoAluguel;
use App\Models\InquilinoConta;
use App\Models\InquilinoFatorDivisor;
use App\Models\InquilinoSaldo;
use App\Utils\InquilinosUtils;
use Illuminate\Support\Facades\DB;

class InquilinosService {


      /**
       * Esse método busca o ID máximo de um inquilino 
       * na tabela de inquilinos
       * @return int
       * 
       */
      public static function getIDMaximo(){
            return Inquilino::max('id');
      }

      public static function getIDMaximoAluguel(){
            return InquilinoAluguel::max('id');
      }

      /**
       * Esse método busca o inquilino na tabela de inquilinos 
       * usando o ID passado no parâmetro para encontra-lo
       * 
       * @return Inquilino
       */
      public static function getInquilinoBy($id){
            return Inquilino::where('id',$id)->first();
      }

      public static function getInquilinoFatorDivisorBy($idInquilino){
            return InquilinoFatorDivisor::where('inquilino_id', $idInquilino)->pluck('fatorDivisor')->first();
      }

      public static function getInquilinoNome($id) {
            
            $query = Inquilino::select('pessoas.nome')
                  ->join('pessoas', 'pessoas.id', '=', 'inquilinos.pessoacodigo')
                  ->where('inquilinos.id', $id)
                  ->first();
                  
            return $query->nome;
      }

      public static function getInquilinoIdFromComprovante($id_comprovante){
            $query = Comprovante::where('id', $id_comprovante)->first();
            return $query->inquilino;
      }

      public static function getInquilinosBySala($sala){
            return Inquilino::where([
                  ['salacodigo', $sala],
                  ['situacao', 'A']
            ])->pluck('id');
      }

      /**
       * Busca no banco de dados informações relevantes para a composição do painel
       * do inquilino. Essas informações são as tais: id da tabela de inquilinos, nome relacionado
       * à tabela de pessoas, nome da sala do imóvel que o inquilino está alocado, o id dessa sala,
       * a quantidade de pessoas na família, valor do Aluguel e o telefone celular dessa pessoa. 
       * 
       * @return Inquilino
       */
      public static function getInfoPainelInquilino($id){
            return Inquilino::select('pessoas.nome', 'inquilinos.id', 'salas.nomesala',
                  'inquilinos.salacodigo', 'inquilinos.qtdePessoasFamilia', 'pessoas.telefone_celular',
                  DB::raw('(SELECT valorAluguel from INQUILINOS_ALUGUEIS 
                              WHERE id = (SELECT MAX(id) FROM INQUILINOS_ALUGUEIS WHERE inquilino = inquilinos.id)) as valorAluguel'))
                  ->join('pessoas', 'pessoas.id', '=', 'inquilinos.pessoacodigo')
                  ->join('salas', 'salas.id', '=', 'inquilinos.salacodigo')
                  ->where('inquilinos.id', $id)
                  ->first();
      }

      /**
       * Busca no banco de dados a pessoa associada ao inquilino e o fator divisor do mesmo
       * 
       */
      public static function getDetalhesInquilino($id){
            return Inquilino::join('pessoas', 'pessoas.id', 'inquilinos.pessoacodigo')
                  ->join('inquilinos_fator_divisor', 'inquilinos_fator_divisor.id', 'inquilinos.id')
                  ->where('inquilinos.id', $id)
                  ->first();
      }

      /**
       * Esse método busca no banco de dados todos os inquilinos ligados a um imóvel
       * Atente que esse método busca inquilinos que estão inativos também 
       * 
       * @param idMovel o ID do imóvel
       * @return Collection
       */
      public static function getInquilinosByImovel($idImovel){
            return Inquilino::select('inquilinos.id')
                  ->join('salas', 'salas.id', 'inquilinos.salacodigo')
                  ->where('salas.imovelcodigo', $idImovel)
                  ->where('inquilinos.situacao', 'A')
                  ->get();
      }

      /**
       * Esse método busca no banco de dados todos os inquilinos (ativos ou não) 
       * cadastrados em um imóvel. O result set desse método inclui o ID do inquilino,
       * a situação em que ele se encontra e o valor do aluguel dele 
       * (esse filtrado pelo ID máximo encontrado na tabela inquilinos_alugueis)
       * 
       * @param imovel ID do imóvel que será usado para identificar as salas e os inquilinos
       * @return Collection um array com os resultados encontrados 
       * 
       */
      public static function getInquilinosBy($imovel){

            return Inquilino::select('inquilinos.id', 'inquilinos.situacao', 
                  DB::raw('(SELECT valorAluguel from INQUILINOS_ALUGUEIS 
                        WHERE id = (SELECT MAX(id) FROM INQUILINOS_ALUGUEIS WHERE inquilino = inquilinos.id)) as valorAluguel'))
                  ->join('salas', 'salas.id', 'inquilinos.salacodigo')
                  ->join('inquilinos_alugueis', 'inquilinos_alugueis.inquilino', 'inquilinos.id')
                  ->where('salas.imovelcodigo', $imovel->idImovel)
                  ->orderBy('inquilinos_alugueis.id', 'desc')
                  ->get();
      }

      /**
       * Esse método retorno uma inquilino com todas as principais relações ligadas a ele
       * @param id do inquilino que será buscado no banco de dados
       * @return \App\Models\Inquilino 
       */
      public static function getInquilinoCompletoBy($id){
            return Inquilino::with([
                  'pessoa',
                  'sala',
                  'fator_divisor',
                  'aluguel' => function($query){
                        $query->with('contrato')->orderBy('id', 'desc')->limit(1);
                  }
            ])->where('id', $id)->first();
      }

      public static function getInquilinosAtivosByImovel($idImovel){
            return array_filter(InquilinosService::getInquilinosBy($idImovel)->toArray(), function($inquilino){
                  return $inquilino['situacao'] === 'A';
            });
      }

      /**
       * Busca o saldo anterior já consolidado do Inquilino. 
       * Se não houver um saldo, retorna 0.0. 
       * 
       * 
       * @return float saldo anterior salvo na tabela inquilinos_saldos de acordo com o  inquilino
       */
      public static function getSaldoAnteriorBy($inquilino){
            $saldo = InquilinoSaldo::where('inquilinocodigo', $inquilino)->first();

            $saldo_anterior = 0.0;
            if($saldo != null){
                  $saldo_anterior = $saldo->saldo_anterior != null ? $saldo->saldo_anterior : 0.0; 
            }

            return  $saldo_anterior;
      }

      /**
       * Busca o saldo atual ainda não consolidado do Inquilino. 
       * Se não houver um saldo, retorna 0.0. 
       * 
       * 
       * @return InquilinoSaldo saldo anterior salvo na tabela inquilinos_saldos de acordo com o  inquilino
       */
      public static function getSaldoAtualBy($inquilino)
      {
            return InquilinoSaldo::select('saldo_atual', 'saldo_anterior', 'observacoes', 'updated_at')
                  ->where('inquilinocodigo', $inquilino)
                  ->orderBy('id', 'desc')
                  ->first();
      
      }


      /**
       * Busca através do ID do inquilino o saldo na tabela inquilinos_saldo
       * @return InquilinoSaldo retorna uma instância do objeto InquilinoSaldo extraído do banco de dados
       */
      public static function getInquilinoSaldoBy($inquilino){
            return InquilinoSaldo::where('inquilinocodigo', $inquilino)->first();
      }

      /**
       * Esse método busca o último valor de aluguel de um inquilino na tabela inquilinos_alugueis
       * 
       * @param inquilino reflete o ID do inquilino que será buscado no banco de dados
       * @return float retorna o campo valorAluguel do registro encontrado no banco de dados; 
       */
      public static function getAluguelAtualizado($inquilino){
            return InquilinosService::getAluguel($inquilino)->valorAluguel;
      }

      /**
       * Esse método busca todos os objetos InquilinoAluguel no banco de dados
       * e os retorna em ordem decrescente de acordo com o ID do objeto
       */
      public static function getAluguelTodos($idInquilino)
      {
            return InquilinoAluguel::where('inquilino', $idInquilino)->orderBy('id','desc')->get();
      }

      /**
       * Esse método busca o valor do aluguel de um inquilino em uma determinada referência
       * passada no segundo parâmetro da assinatura da função.
       * Esse método é null-safe caso o final da validade do aluguel não esteja setado no banco de dados
       * 
       * @param inquilino reflete o ID do inquilino que será buscado no banco de dados;
       * @param referencia reflete a referência procurada nos intervalos de inicioValidade e fimValidade 
       * @return InquilinoAluguel um objeto com as informações contidas no registro 
       */
      public static function getAluguelBy($inquilino, $referencia){
            return InquilinoAluguel::where('inquilino', $inquilino)
                  ->where('iniciovalidade', '<=', $referencia)
                  ->where(function ($query) use ($referencia){
                        $query->where('fimvalidade', '>=', $referencia)
                              ->orWhereNull('fimvalidade');
                  })
                  ->orderBy('id', 'desc')
                  ->first();
      }

      /**
       * Esse método busca o registro do aluguel mais atualizado de acordo com o ID máximo 
       * do inquilino fornecido atavés do parâmetro
       * @return \App\Models\InquilinoAluguel 
       */
      public static function getAluguel($inquilino){
            return InquilinoAluguel::where('inquilino', $inquilino)->orderBy('id','desc')->first(); 
      }

      /**
       * 
       * @return Collection um array com os ID das contas 
       */
      public static function buscarIdInquilinoContaByReferencia($idInquilino, $ano_referencia, $mes_referencia){
            return InquilinoConta::select('inquilinos_contas.id')
                ->join('contas_imoveis', 'contas_imoveis.id', 'inquilinos_contas.contacodigo')
                ->where('inquilinos_contas.inquilinocodigo', $idInquilino)
                ->where('contas_imoveis.ano', $ano_referencia)
                ->where('contas_imoveis.mes', $mes_referencia)
                ->get();   
      }

      /**
       * Retorna a soma do aluguel com todas as contas do ano e mês para um determinado inquilino
       */
      public static function getValoresSomadosMes($inquilino_id, $ano, $mes){

            $aluguel = InquilinosService::getAluguelAtualizado($inquilino_id);
            $soma_contas = InquilinoConta::select('inquilinos_contas.valorinquilino')
                  ->join('contas_imoveis', 'contas_imoveis.id', 'inquilinos_contas.contacodigo')
                  ->where('inquilinos_contas.inquilinocodigo', $inquilino_id)
                  ->where('contas_imoveis.ano', $ano)
                  ->where('contas_imoveis.mes', $mes)
                  ->sum('inquilinos_contas.valorinquilino');


            return $aluguel + $soma_contas;

      }


      /**
       * Esse método busca todos os inquilinos ativos de acordo com os ID dos imóveis 
       * passados no parâmetro da assinatura da função. Esse método é usado para construir
       * a lista dos inquilinos. Os ID de imóveis passados são previamente filtrados de 
       * acordo com o usuário. Essa aplicação conjunta dos dois métodos, um que filtre os imóveis
       * pelo usuário, e esse, garantem a integridade da informação.  
       * 
       * @return Collection
       */
      public static function getListaInquilinosAtivosTodosImoveis($imoveis){

            /* A subquery contida no DB::raw faz a busca do valorAluguel de acordo com o maior ID disponível 
               para aquele inquilino identificado pelo ID
            */
            $inquilinos_ativos = Inquilino::select('inquilinos.id', 'pessoas.nome', 'pessoas.telefone_celular',
                  DB::raw('(SELECT valoraluguel FROM inquilinos_alugueis 
                        WHERE id = (SELECT MAX(id) FROM inquilinos_alugueis WHERE inquilino = inquilinos.id)) as valorAluguel'))
              ->join('pessoas', 'pessoas.id', '=', 'inquilinos.pessoacodigo')
              ->join('salas', 'salas.id', 'inquilinos.salacodigo')
              ->whereIn('salas.imovelcodigo', $imoveis)
              ->where('inquilinos.situacao', '=', 'A')
              ->get();

      
            return $inquilinos_ativos;
      }

      public static function getSalaImovelBy($inquilino){
            $inquilino = Inquilino::with('sala')->where('id', $inquilino)->first(); 
            $salaImovel = $inquilino->has('sala') ? ImoveisService::getSalaImovelBy($inquilino->sala->id) : null; 
            return $salaImovel;
      }

      public static function getContratoVigente($idInquilino){
            $aluguel = InquilinosService::getAluguel($idInquilino);
            $contrato = Contrato::where('aluguel', $aluguel->id)->first();
            
            if($contrato === null ){
                  $contrato = new Contrato();
            }
            
            $contrato->valorAluguel = $aluguel->valorAluguel;
      
            return $contrato; 
            
      }

      public static function getListaInputInquilinos(){
            $imoveis = ImoveisService::getImoveisByUsuarioLogado();
            return  Inquilino::select('inquilinos.id', 'pessoas.nome')
            ->join('pessoas', 'pessoas.id', '=', 'inquilinos.pessoacodigo')
            ->join('salas', 'salas.id', '=', 'inquilinos.salacodigo')
            ->where('inquilinos.situacao', '=', 'A')
            ->whereIn('salas.imovelcodigo', $imoveis)
            ->get();

      }

      /**
       * Esse método busca pela data da conta mais recente inserida na tabela inquilinos_contas
       */
      public static function getDataUltimoCalculoContas($inquilino){
            return InquilinoConta::select('created_at')
                  ->where('inquilinocodigo', $inquilino)
                  ->orderBy('id', 'desc')
                  ->first();
      }

      /**
       * Esse método busca a soma de todas as contas registradas no banco de 
       * dados para o inquilino passado no parâmetro
       * 
       * @return float do valor de todas as contas registradas
       */
      public static function getSomaDeTodasContasRegistradas($idInquilino): float
      {
           return InquilinoConta::where('inquilinocodigo', $idInquilino)
            ->aggregate('sum', ['valorinquilino']);
      }

      public static function getTodasContasRegistradas($idInquilino): array 
      {
            $contas = InquilinoConta::where('inquilinocodigo', $idInquilino)->get();
            $soma = array_sum(array_column($contas->toArray(), 'valorinquilino'));

            $contas_auditoria = [];
            foreach ($contas as $conta) {
                  $contas_auditoria[] = $conta->toArray();
            }

            $contas_auditoria = json_encode($contas_auditoria);

            return ['soma' => $soma, 'contas' => $contas_auditoria ];
      }

      public static function getSomaDeTodosOsComprovantesRegistrados($idInquilino): array
      {
            $comprovantes = ComprovantesService::getComprovantesTodosRegistrados($idInquilino);
            $soma = array_sum(array_column($comprovantes->toArray(), 'valor'));

            $comprovantes_auditoria = [];
            foreach ($comprovantes as $comprovante) {
                  $comprovantes_auditoria[] = $comprovante->toArray();
            }

            $comprovantes_auditoria = json_encode($comprovantes_auditoria);

            return [ 'soma' => $soma, 'comprovantes' => $comprovantes_auditoria];
      }

      public static function getSomaTodosAlugueis($inquilino){

            $alugueis = InquilinosService::getAluguelTodos($inquilino);
            $soma = InquilinosUtils::getSomaDeTodosAlugueisBy($inquilino, $alugueis);

            $alugueis_auditoria = [];
            foreach ($alugueis as $aluguel) {
                  $alugueis_auditoria[] = $aluguel->toArray();
            }

            $alugueis_auditoria = json_encode($alugueis_auditoria);

            return [ 'soma' => $soma, 'alugueis' => $alugueis_auditoria ];
      }


}