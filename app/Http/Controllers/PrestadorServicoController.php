<?php

namespace App\Http\Controllers;

use App\Http\Dto\EnderecoDTOBuilder;
use App\Http\Dto\PessoaDTOBuilder;
use App\Models\Endereco;
use App\Models\Pessoa;
use App\Models\PrestadorServico;
use App\Services\ImobiliariasService;
use App\Services\ImoveisService;
use App\Services\PrestadorServicoService;
use App\Utils\CollectionUtils;
use App\Utils\ProjectUtils;
use App\ValueObjects\AppDataVO;
use App\ValueObjects\MensagemVO;
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
            return view('app.painel-prestadores-servicos', compact('titulo', 'mensagem')); 
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
                $telefone = ProjectUtils::tirarMascara($request->input('telefone-trabalho'));

                $pessoa_dto = (new PessoaDTOBuilder)
                    ->withNome($nome)
                    ->withCpf($cpf)
                    ->withCnpj($cnpj)
                    ->withTelefoneCelular($telefone)
                    ->withEndereco($endereco_dto)
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


                DB::transaction(function($closure) use ($pessoa_dto, $tipos, $imobiliaria){

                    $endereco_trabalho = null;
                    if($pessoa_dto->getEndereco() !== null){
                        $endereco = $pessoa_dto->getEndereco();

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

                    Pessoa::create([
                        'nome' => $pessoa_dto->getNome(),
                        'cnpj' => $pessoa_dto->getCnpj(),
                        'cpf' => $pessoa_dto->getCpf(),
                        'telefone_celular' => $pessoa_dto->getTelefoneCelular(),
                        'endereco_trabalho' => $endereco_trabalho
                    ]);

                    PrestadorServico::create([
                        'pessoa_id' => DB::getPdo()->lastInsertId()
                    ]);

                    $prestador_id = DB::getPdo()->lastInsertId();

                    foreach ($tipos as $key => $value) {
                        $sql = 'INSERT INTO PRESTADORES_TIPOS(PRESTADOR_ID, TIPO_ID) VALUES (?,?)';
                        $bindings = [$prestador_id, $value];
                        DB::insert($sql, $bindings);
                    }

                    $sql = 'INSERT INTO PRESTADORES_IMOBILIARIAS(PRESTADOR_ID, IMOBILIARIA_ID) VALUES(?,?)';
                    $bindings = [$prestador_id, $imobiliaria]; 
                    DB::insert($sql, $bindings);

                });

                $mensagem_vo = new MensagemVO('sucesso', 'O prestador '.$pessoa_dto->getNome().' foi cadastrado com sucesso');
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
        $search_input_vo = new SearchInputVO($prestadores);
        return response()->json($search_input_vo->getJson());

       } catch (\Throwable $th) {
            $mensagem_vo = new MensagemVO('falha', 'Não foi possível buscar a lista de prestadores');
            $mensagem = $mensagem_vo->getJson();
            return redirect()->back()->with('erros', $th->getMessage())->with($mensagem);
       }
    }
}
