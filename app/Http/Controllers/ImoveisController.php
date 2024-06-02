<?php

namespace App\Http\Controllers;

use App\Models\ContaImovel;
use App\Models\Imovel;
use App\Models\Inquilino;
use App\Models\InquilinoConta;
use App\Models\Sala;
use App\Models\TipoConta;
use App\Services\CalculoContasService;
use App\Services\TipoContasService;
use App\Services\UsuarioService;
use App\Utils\ProjectUtils;
use Illuminate\Http\Request;

class ImoveisController extends Controller
{

    public function index(){

        $titulo = 'Lista de Imóveis';
        $idUsuario = UsuarioService::getUsuarioLogado();

        $imoveis = Imovel::select('imoveis.id', 'imoveis.nomefantasia', 
            'enderecos.logradouro', 'enderecos.bairro', 'enderecos.numero', 'enderecos.cep', 'enderecos.cidade')
            ->join('enderecos', 'enderecos.id', 'imoveis.endereco')
            ->join('users_imoveis', 'users_imoveis.idImovel', 'imoveis.id')
            ->where('users_imoveis.idUsuario', $idUsuario)
            ->get();

        return view('app.imoveis', compact('titulo', 'imoveis'));
    }

    public function cadastrar(Request $request){

        $titulo = 'Cadastrar novo imóvel';

        if($request->isMethod('POST')){
            
        }

        return view('app.cadastro-imovel', compact('titulo'));

    }

    public function detalharImovel($imovel){
        $imovel = Imovel::where('id', $imovel)->first();
        $titulo = 'Painel do Imóvel: '.$imovel->nomefantasia; 
        $id = $imovel->id;

        return view('app.painel-imovel', compact('titulo', 'id')); 
    }

    public function listarContas($idImovel){

        $contas_imovel = ContaImovel::select('contas_imoveis.id', 'contas_imoveis.valor', 
                'contas_imoveis.tipocodigo','contas_imoveis.ano', 'contas_imoveis.mes')
            ->join('salas', 'salas.id', 'contas_imoveis.salacodigo')
            ->where('salas.imovelcodigo', $idImovel)
            ->orderBy('contas_imoveis.id', 'desc')
            ->groupBy('contas_imoveis.id', 'contas_imoveis.valor', 'contas_imoveis.tipocodigo', 'contas_imoveis.ano', 'contas_imoveis.mes')
            ->paginate(15); 

        return $contas_imovel;
    }

    public function executarCalculoContas($idImovel, $periodoReferencia = null){

        $titulo = 'Executar cálculo de contas do imóvel';
        $nomeImovel = Imovel::find($idImovel)->pluck('nomefantasia');
        $referencia_calculo = $periodoReferencia != null ? $periodoReferencia : ProjectUtils::getAnoMesSistemaSemMascara();

        
        $ano_sistema = ProjectUtils::getAnoFromReferencia($referencia_calculo);
        $mes_sistema = ProjectUtils::getMesFromReferencia($referencia_calculo);

        $contas_imovel = ContaImovel::select('contas_imoveis.id', 'contas_imoveis.valor', 'contas_imoveis.tipocodigo',
                            'contas_imoveis.salacodigo')
                            ->join('salas', 'salas.id', 'contas_imoveis.salacodigo')
                            ->where('salas.imovelcodigo', $idImovel)
                            ->where('contas_imoveis.ano', $ano_sistema)
                            ->where('contas_imoveis.mes', $mes_sistema)
                            ->orderBy('contas_imoveis.id', 'desc')
                            ->groupBy('contas_imoveis.id', 'contas_imoveis.valor', 'contas_imoveis.tipocodigo', 'contas_imoveis.salacodigo')
                            ->get();
        
        $salas = Sala::select('id', 'nomesala')->where('imovelcodigo', $idImovel)->get();

        // Essa parte do código é feita para associar o nome de descrição da sala à conta
        foreach ($contas_imovel as $conta) {
            foreach ($salas as $sala) {    
                if($sala->id == $conta->salacodigo){
                    $conta->nomesala = $sala->nomesala;
                }        
            }
            $conta->tipoconta = TipoContasService::getDescricaoTipoContaBy($conta->tipocodigo);   
        }

        $itens_carrossel = [$referencia_calculo-1, $referencia_calculo, $referencia_calculo+1];
        $mensagemConfirmacaoModal = 'Deseja realizar o cálculo das contas do imóvel '.$nomeImovel->first().
            ' para o período de referência: '.$referencia_calculo.'?';

        return view('app.painel-calcular-contas', compact('titulo', 'contas_imovel', 'itens_carrossel', 
            'mensagemConfirmacaoModal', 'idImovel', 'referencia_calculo'));

    }

    public function calculo($idImovel, $referencia){

        $calcular_contas_service = new CalculoContasService();
        $calcular_contas_service->calcularContasInquilinos($idImovel, $referencia);

        $ano_referencia = ProjectUtils::getAnoFromReferencia($referencia);
        $mes_referencia = ProjectUtils::getMesFromReferencia($referencia);


        $inquilinos = Inquilino::select('inquilinos.id', 'pessoas.nome', 'inquilinos.valorAluguel')
            ->join('pessoas', 'pessoas.id', 'inquilinos.pessoacodigo')
            ->join('salas', 'salas.id', 'inquilinos.salacodigo')
            ->where('salas.imovelcodigo', $idImovel)
            ->where('inquilinos.situacao', 'A')
            ->get();

        foreach ($inquilinos as $inquilino) {
            $contas_inquilino = InquilinoConta::select('inquilinos_contas.valorinquilino', 'contas_imoveis.tipocodigo')
                ->join('contas_imoveis', 'contas_imoveis.id', 'inquilinos_contas.contacodigo')
                ->where('inquilinos_contas.inquilinocodigo', $inquilino->id)
                ->where('contas_imoveis.ano', $ano_referencia)
                ->where('contas_imoveis.mes', $mes_referencia)
                ->get();
            
            foreach ($contas_inquilino as $conta) {
                $descricao_codigo = TipoContasService::getDescricaoTipoContaBy($conta->tipocodigo);
                $conta->descricao = $descricao_codigo;
            }
            
            $inquilino->contas_inquilino = $contas_inquilino;
        }
        

        return response()->json(['mensagem' => 'Chegou aqui!', 'inquilinos' => $inquilinos]);
    }
}
