<?php

namespace App\Http\Controllers;

use App\Constants\TiposTelefone;
use App\Http\Dto\EnderecoDTOBuilder;
use App\Http\Dto\PessoaDTOBuilder;
use App\Http\Dto\PrestadorServicoDTOBuilder;
use App\Http\Dto\TelefoneDTOBuilder;
use App\Models\Endereco;
use App\Models\Pessoa;
use App\Models\PrestadorServico;
use App\Models\Telefone;
use App\Services\ImobiliariasService;
use App\Services\ImoveisService;
use App\Services\PrestadorServicoService;
use App\Utils\CollectionUtils;
use App\Utils\ProjectUtils;
use App\Utils\TelefonesUtils;
use App\ValueObjects\AppDataVO;
use App\ValueObjects\MensagemVO;
use App\ValueObjects\PrestadorServicoVO;
use App\ValueObjects\SearchInputVO;
use App\ValueObjects\SelectOptionVO;
use Doctrine\Common\Cache\Psr6\InvalidArgument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestadorServicoController extends Controller
{

    public function index(){

        $titulo = 'Painel das informações dos prestadores de serviço';
        $mensagem = null;
        try {

            $prestadores_models = PrestadorServicoService::getListaPainelPrestadores(); 
            $prestadores = [];
            foreach ($prestadores_models as $prestador_model) {
                $vo = PrestadorServicoVO::buildVO($prestador_model);
                $prestadores[] = $vo;
            }
            return view('app.painel-prestadores-servicos', compact('titulo', 'mensagem', 'prestadores')); 
        } catch (\Throwable $th) {
            return redirect()->back()->with('erros', 'Não foi possível acessar os prestadores de serviço '.$th->getMessage());
        }

    }

    public function cadastrarPrestador(Request $request){
        $titulo = 'Cadastrando um novo prestador de serviços';
        $mensagem = null;
        $prestador = null; 
        $imobiliarias = ImobiliariasService::getListaImobiliariasSelect();
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

            $appData = $appData_vo->getJson();

            if($request->isMethod('POST')){

                $endereco_dto = null;
                if($request->input('cadastrar-endereco-toggle') === 'on'){

                    $cep = ProjectUtils::tirarMascara($request->input('cep'));
                    $numero = $request->input('numero-endereco');
                    $logradouro = $request->input('logradouro');
                    $bairro = $request->input('bairro');
                    $uf = $request->input('uf');
                    $cidade = $request->input('cidade');

                    $endereco_dto = (new EnderecoDTOBuilder)
                        ->withCep($cep)
                        ->withNumero($numero)
                        ->withCidade($cidade)
                        ->withUf($uf)
                        ->withLogradouro($logradouro)
                        ->withBairro($bairro)
                        ->build();
                }


                $cnpj = ProjectUtils::tirarMascara($request->input('cnpj-prestador'));
                $cpf = ProjectUtils::tirarMascara($request->input('cpf-prestador'));
                $nome = $request->input('prestador-nome');
                $telefone_input = ProjectUtils::tirarMascara($request->input('telefone-trabalho'));
                $telefone = TelefonesUtils::getDddTelefone($telefone_input);

                $telefone_dto = (new TelefoneDTOBuilder)
                    ->withDdd($telefone['ddd'])
                    ->withTelefone($telefone['telefone'])
                    ->withTipo(TiposTelefone::CELULAR)
                    ->build();

                $tipos = CollectionUtils::getPrimeiroValorParaQualquerChave(CollectionUtils::getAssociativeArray(
                    $request->input(), '-', 2, 'tipo-prestador-'
                ));
                
                if(empty($tipos)){
                    throw new InvalidArgument('Os tipos de serviços prestados pelo prestador não foram declarados.');

                }

                $imobiliaria = $request->input('imobiliaria-select');
                if($imobiliaria === '0' || $imobiliaria === null){
                    throw new InvalidArgument('A imobiliária em que o prestador prestará serviço não foi definida. ');
                }

                $prestador_dto = (new PrestadorServicoDTOBuilder)
                    ->withNome($nome)
                    ->withCnpj($cnpj)
                    ->withCpf($cpf)
                    ->withTelefone($telefone_dto)
                    ->withEndereco($endereco_dto)
                    ->withTipos($tipos)
                    ->withImobiliaria($imobiliaria)
                    ->build();

                DB::transaction(function($closure) use ($prestador_dto){
                    $endereco_trabalho = null;
                    if($prestador_dto->getEndereco() !== null){
                        $endereco = $prestador_dto->getEndereco();

                        Endereco::create([
                            'cep' => $endereco->getCep(),
                            'numero' => $endereco->getNumero(),
                            'cidade' => $endereco->getCidade(),
                            'uf' => $endereco->getUf(),
                            'bairro' => $endereco->getBairro(),
                            'logradouro' => $endereco->getLogradouro()
                        ]);

                        $endereco_trabalho = DB::getPdo()->lastInsertId();

                    }

                    Telefone::create([
                        'ddd' => $prestador_dto->getTelefone()->getDdd(),
                        'telefone' => $prestador_dto->getTelefone()->getTelefone(),
                        'tipo_telefone' => $prestador_dto->getTelefone()->getTipo() 
                    ]);
                    $telefone = DB::getPdo()->lastInsertId();


                    PrestadorServico::create([
                        'nome' => $prestador_dto->getNome(),
                        'cpf' => $prestador_dto->getCpf(),
                        'cnpj' => $prestador_dto->getCnpj(),
                        'endereco' => $endereco_trabalho,
                        'telefone' => $telefone
                    ]);


                    $prestador_id = DB::getPdo()->lastInsertId();

                    foreach ($prestador_dto->getTipos() as $key => $value) {
                        $sql = 'INSERT INTO PRESTADORES_TIPOS(PRESTADOR_ID, TIPO_ID) VALUES (?,?)';
                        $bindings = [$prestador_id, $value];
                        DB::insert($sql, $bindings);
                    }

                    $sql = 'INSERT INTO PRESTADORES_IMOBILIARIAS(PRESTADOR_ID, IMOBILIARIA_ID) VALUES(?,?)';
                    $bindings = [$prestador_id, $prestador_dto->getImobiliaria()]; 
                    DB::insert($sql, $bindings);

                });

                $mensagem_vo = new MensagemVO('sucesso', 'O prestador '.$prestador_dto->getNome().' foi cadastrado com sucesso');
                $mensagem = $mensagem_vo->getJson();
            }

            return view('app.cadastro-prestador-servico', compact('titulo', 'mensagem', 'prestador', 'appData', 'imobiliarias'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('erros', 'Não foi possível cadastrar um prestador de serviço. '.$th->getMessage());
        }
    }

    public function editarPrestador(Request $request, $idPrestador){
        $titulo = 'Editando o prestador';
        $mensagem = null;
        try {

        } catch (\Throwable $th) {
            return redirect()->back()->with('erros', 'Não foi possível encontrar o prestador de serviço selecionado '.$th->getMessage());
        }
    }

    public function buscarLista($param = null){
       try {

        $prestadores = PrestadorServicoService::getNomePrestadoresLike($param);

        $search_input_vo = new SearchInputVO($prestadores->toArray());
        return response()->json($search_input_vo->getJson());

       } catch (\Throwable $th) {
            $mensagem_vo = new MensagemVO('falha', 'Não foi possível buscar a lista de prestadores. Erro: '.$th->getMessage());
            $mensagem = $mensagem_vo->getJson();
            return response()->json(['mensagem' => $mensagem]);
       }
    }
}
