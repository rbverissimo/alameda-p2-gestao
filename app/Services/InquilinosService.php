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
use App\Utils\ProjectUtils;
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

      /**
       * Busca o model InquilinoFatorDivisor do banco de dados 
       * dado um inquilino passado pelo parâmetro. 
       */
      public static function getInquilinoFatorDivisor($idInquilino)
      {
            return InquilinoFatorDivisor::where('inquilino_id', $idInquilino)
                  ->orderBy('id','desc')
                  ->first();
      }

      public static function getInquilinoNome($id) {
            $inquilino = Inquilino::select('nome')
                  ->where('inquilinos.id', $id)
                  ->first();    
            return $inquilino->nome;
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
       * do inquilino. Essas informações são as tais: id e nome da tabela de inquilinos,
       * nome da sala do imóvel que o inquilino está alocado, o id dessa sala,
       * a quantidade de pessoas na família, valor do Aluguel e o telefone celular. 
       * 
       * @return Inquilino
       */
      public static function getInfoPainelInquilino($id){
            return Inquilino::select('inquilinos.nome', 'inquilinos.id', 'salas.nomesala',
                  'inquilinos.salacodigo', 'inquilinos.qtdePessoasFamilia',
                  DB::raw('(SELECT valorAluguel from INQUILINOS_ALUGUEIS 
                              WHERE id = (SELECT MAX(id) FROM INQUILINOS_ALUGUEIS WHERE inquilino = inquilinos.id)) as valorAluguel'),
                  DB::raw('(SELECT (t.ddd || t.telefone) as telefone_celular from TELEFONES t 
                              JOIN INQUILINOS_TELEFONES it on it.telefone_id = t.id
                              WHERE it.inquilino_id = inquilinos.id AND t.tipo_telefone = 1010 limit 1) as telefone_celular'))
                  ->join('salas', 'salas.id', '=', 'inquilinos.salacodigo')
                  ->where('inquilinos.id', $id)
                  ->first();
      }

      /**
       * Busca no banco de dados os dados da tabela de inquilinos 
       * junto de seu fator divisor se ele exisitr
       * 
       */
      public static function getDetalhesInquilino($id){
            return Inquilino::with('fator_divisor', 'telefone')->find($id);
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
       * Esse método busca o ID e o nome de todos os inquilinos de um determinado
       * imóvel passado no primeiro parâmetro do método
       * 
       */
      public static function getIdNomeInquilinosAtivosByImovel($imovel){
            return Inquilino::select('inquilinos.id', 'inquilinos.nome')
                  ->join('salas', 'salas.id', 'inquilinos.salacodigo')
                  ->where([['salas.imovelcodigo', $imovel], ['inquilinos.situacao', 'A']])
                  ->get();
      }

      /**
       * Esse método retorno uma inquilino com todas as principais relações ligadas a ele
       * @param id do inquilino que será buscado no banco de dados
       * @return \App\Models\Inquilino 
       */
      public static function getInquilinoCompletoBy($id){
            return Inquilino::with([
                  'sala',
                  'fator_divisor',
                  'telefone',
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

      public static function getInquilinoContaById($idConta){
            return InquilinoConta::where('id', $idConta)->first();
      }

      public static function getContasInquilinoBy($idInquilino, $referencia)
      {

            $ano_referencia = ProjectUtils::getAnoFromReferencia($referencia);
            $mes_referencia = ProjectUtils::getMesFromReferencia($referencia);

            return InquilinoConta::select('inquilinos_contas.id', 'inquilinos_contas.dataVencimento', 
                  'inquilinos_contas.valorinquilino', 'inquilinos_contas.quitada')
                  ->join('contas_imoveis', 'contas_imoveis.id', '=', 'inquilinos_contas.contacodigo')
                  ->where([
                        ['inquilinos_contas.inquilinocodigo', $idInquilino],
                        ['contas_imoveis.ano', $ano_referencia],
                        ['contas_imoveis.mes', $mes_referencia]
                  ])
                  ->get();
      }


      public static function getListaContasInquilinosByIdImovel($idContaImovel){
            return InquilinoConta::select('id', 'dataVencimento', 'valorinquilino', 'quitada')->
                  where('contacodigo', $idContaImovel)
                  ->get();
      }

      /**
       * Esse método retorna as contas de inqulinos de uma determinada sala 
       * passada no primeiro parâmetro a partir da conta do imóvel conectada a ela
       * 
       */
      public static function getContasInquilinoBySala($sala, $idContaImovel)
      {
            return InquilinoConta::select('inquilinos_contas.*')->from('inquilinos_contas')
                  ->join('contas_imoveis', 'contas_imoveis.id', '=', 'inquilinos_contas.contacodigo')
                  ->join('salas', 'salas.id', '=', 'contas_imoveis.salacodigo')
                  ->where([['salas.id', $sala], ['contas_imoveis.id', $idContaImovel]])
                  ->get();
      }

      /**
       * 
       * @return Collection um array com os ID das contas 
       */
      public static function buscarIdInquilinoContaByReferencia($idInquilino, $ano_referencia, $mes_referencia)
      {
            return InquilinoConta::select('inquilinos_contas.id', 'inquilinos_contas.valorinquilino', 'contas_imoveis.tipocodigo', 
                        'tipocontas.descricao')
                ->join('contas_imoveis', 'contas_imoveis.id', 'inquilinos_contas.contacodigo')
                ->join('tipocontas', 'tipocontas.id', 'contas_imoveis.tipocodigo')
                ->where([
                        ['inquilinos_contas.inquilinocodigo', $idInquilino],
                        ['contas_imoveis.ano', $ano_referencia], 
                        ['contas_imoveis.mes', $mes_referencia]
                  ])
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

            $inquilinos_ativos = Inquilino::select('inquilinos.id', 'inquilinos.nome',
                  DB::raw('(SELECT valoraluguel FROM inquilinos_alugueis 
                        WHERE id = (SELECT MAX(id) FROM inquilinos_alugueis WHERE inquilino = inquilinos.id)) as valorAluguel'),
                  DB::raw('(SELECT (t.ddd || t.telefone) as telefone_celular from TELEFONES t 
                        JOIN INQUILINOS_TELEFONES it on it.telefone_id = t.id
                        WHERE it.inquilino_id = inquilinos.id AND t.tipo_telefone = 1010 limit 1) as telefone_celular'))
              ->join('salas', 'salas.id', 'inquilinos.salacodigo')
              ->whereIn('salas.imovelcodigo', $imoveis)
              ->where('inquilinos.situacao', '=', 'A')
              ->get();

      
            return $inquilinos_ativos;
      }

      /**
       * Este é um método flexível usado para filtrar inquilinos através de uma where clause passada
       * no parâmetro. Não é impossível, mas também não é recomendado, usar este método para buscar múltiplos
       * valores do mesmo parâmetro (similar ao WHERE IN ). 
       * @param whereClause array com cláusulas que servirão de filtro para query
       * 
       */
      public static function getListaInquilinosFiltros($whereClause){
            return Inquilino::select('inquilinos.id', 'inquilinos.nome',
            DB::raw('(SELECT valoraluguel FROM inquilinos_alugueis 
                  WHERE id = (SELECT MAX(id) FROM inquilinos_alugueis WHERE inquilino = inquilinos.id)) as valorAluguel'))
                  ->join('salas', 'salas.id', 'inquilinos.salacodigo')
                  ->where($whereClause)
            ->get();
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

      public static function getListaInputInquilinos($idImovel = null){
            $imoveis = $idImovel === null ? ImoveisService::getImoveisByUsuarioLogado() : [$idImovel];
            return  Inquilino::select('inquilinos.id', 'inquilinos.nome')
            ->join('salas', 'salas.id', '=', 'inquilinos.salacodigo')
            ->where('inquilinos.situacao', '=', 'A')
            ->whereIn('salas.imovelcodigo', $imoveis)
            ->get();
      }

      /**
       * Esse método busca todos os inquilinos de um imóvel com base
       * em uma sala passada pelo parâmetro da função
       */
      public static function getInquilinosImovelUseSala($idSala){
            $inquilinos = Inquilino::select('inquilinos.id', 'inquilinos.nome')
                  ->join('salas as s', 's.id', '=', 'inquilinos.salacodigo')
                  ->join('imoveis as im', 'im.id', '=', 's.imovelcodigo')
                  ->where('inquilinos.situacao', 'A')
                  ->whereIn('im.id', function($query) use ($idSala){
                      $query->select('imovelcodigo')->from('salas')->where('id', $idSala); 
                  })
                  ->get();
            return $inquilinos;        
      }

      /**
       * Esse método busca todos os inquilinos de um imóvel a partir de um
       * único inquilino fornecido através do parâmetro
       */
      public static function getInquilinosImovelUseInquilino($inquilino){
            $inquilinos = Inquilino::select('inquilinos.id', 'inquilinos.nome')
                  ->join('salas as s', 's.id', '=', 'inquilinos.salacodigo')
                  ->join('imoveis as im', 'im.id', '=', 's.imovelcodigo')
                  ->where('inquilinos.situacao', 'A')
                  ->whereIn('im.id', function($query) use ($inquilino){
                $query->select('imovelcodigo')->from('salas')
                        ->join('inquilinos as iss', 'iss.salacodigo', '=', 'salas.id')
                        ->where('salas.id', $inquilino)
                        ->groupBy('salas.id'); 
            })
            ->get();

            return $inquilinos;
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