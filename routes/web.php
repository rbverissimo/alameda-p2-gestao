<?php

use App\Http\Controllers\CalculoContasController;
use App\Http\Controllers\ComprovantesTransferenciaController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ImoveisController;
use App\Http\Controllers\ListaInquilinosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PainelInquilinoController;
use App\Http\Controllers\PainelPrincipalController;
use App\Http\Controllers\RaizController;
use App\Http\Controllers\SalasController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(RaizController::class)->group(function () {
    Route::get('/', 'index')->name('root');
});

Route::prefix('sessao')->middleware('autenticacao')->group(function(){
    Route::post('/', [SessionController::class, 'getFlashedSessionData'])->name('buscar-session-data');
});

Route::controller(LoginController::class)->group(function(){
    Route::get('/login/{erro?}', 'index')->name('login');
    Route::post('/login', 'login')->name('login');
    Route::middleware('autenticacao')->get('/logout', 'sair')->name('logout');
});

Route::middleware('autenticacao')->get('/painel-principal', [PainelPrincipalController::class, 'index'])
    ->name('painel-principal');

Route::middleware('autenticacao')
    ->get('/listar-inquilinos', [ListaInquilinosController::class, 'lista'])
    ->name('listar-inquilinos');


Route::middleware('autenticacao')->controller(CalculoContasController::class)->group(function(){
    Route::get('/calculo-contas', 'calculoContas')
    ->name('calculo-contas');
    Route::post('/calculo-contas', 'calculoContas')
    ->name('calculo-contas');
    Route::put('/calculo-contas/edit/{id}', 'regravarConta')->name('regravar-conta');
    Route::get('/calculo-contas/edit/{id}', 'regravarConta')->name('regravar-conta');
    Route::get('/calculo-contas/delete/{id}', 'deletarConta')->name('deletar-conta');
});

Route::prefix('inquilino')->middleware('autenticacao')->group(function(){
    Route::get('/{id}', [PainelInquilinoController::class, 'painel_inquilino'])->name('painel-inquilino');
    Route::get('/cadastrar-inquilino/cadastro', [PainelInquilinoController::class, 'cadastrarInquilino'])->name('cadastrar-inquilino');
    Route::post('/cadastrar-inquilino/cadastro', [PainelInquilinoController::class, 'cadastrarInquilino'])->name('cadastrar-inquilino');
    Route::get('/detalhe/{id}', [PainelInquilinoController::class, 'detalharInquilino'])->name('detalhar-inquilino');
    Route::post('/detalhe/{id}', [PainelInquilinoController::class, 'editarInquilino'])->name('editar-inquilino');
    Route::put('/detalhe/{id}', [PainelInquilinoController::class, 'editarInquilino'])->name('editar-inquilino');
    Route::get('/toggle-inquilino/{id}', [PainelInquilinoController::class, 'toggleSituacaoAtividadeInquilino'])->name('toggle-inquilino');
    Route::delete('/excluir-registro-inquilino/{id}', [PainelInquilinoController::class, 'excluirInqulino'])->name('excluir-inquilino');
    Route::get('/show-situacao-financeira/{id}/{ref?}', [PainelInquilinoController::class, 'mostrarSituacaoFinanceira'])->name('mostrar-situacao-financeira');
});



Route::middleware('autenticacao')->controller(ComprovantesTransferenciaController::class)->group(function(){
    Route::get('/comprovantes-transferencia',  'index')
    ->name('comprovantes-transferencia');
    Route::post('/comprovantes-transferencia', 'index')
    ->name('comprovantes-transferencia');
    Route::get('comprovantes-transferencia/add/{id}', 'index')->name('comprovante-adicionar');
    Route::get('/comprovantes-transferencia/{id}', 'comprovantesPorInquilino')
    ->name('comprovantes-inquilino');
    Route::get('/comprovantes-transferencia/search/{param}/{id}', 'comprovantesPor')->name('filtrar-comprovante-por');
    Route::get('/comprovantes-transferencia/edit/{id}', 'editarComprovante')->name('comprovante-editar');
    Route::put('/comprovantes-transferencia/edit/{id}', 'editarComprovante')
    ->name('comprovante-editar');
    Route::get('/comprovantes-transferencia/delete/{id}', 'deletarComprovante')->name('comprovante-deletar');
});

Route::prefix('imoveis')->middleware('autenticacao')->group(function(){
    Route::get('/', [ImoveisController::class, 'index'])->name('imoveis');
    Route::get('/{id}', [ImoveisController::class, 'detalharImovel'])->name('imoveis-detalhar');
    Route::get('/listar-contas/{id}', [ImoveisController::class, 'listarContas'])->name('imoveis-listar-contas');
    Route::get('/executar-calculo/{id}/{ref?}', [ImoveisController::class, 'executarCalculoContas'])->name('executar-calculo-contas');
    Route::get('/executar-calculo/calculo/{id}/{ref}', [ImoveisController::class, 'calculo'])->name('realizar-calculo');
    Route::get('/cadastrar-imovel/cadastro', [ImoveisController::class, 'cadastrar'])->name('cadastrar-imovel');
    Route::post('/cadastrar-imovel/cadastro', [ImoveisController::class, 'cadastrar'])->name('cadastrar-imovel');
});

Route::prefix('salas')->middleware('autenticacao')->group(function(){
    Route::get('/listar-salas/{id}', [SalasController::class, 'listar-salas'])->name('listar-salas');
    Route::get('/cadastrar-sala/{id}', [SalasController::class, 'cadastrar'])->name('cadastrar-sala');
    Route::post('/cadastrar-sala/{id}', [SalasController::class, 'cadastrar'])->name('cadastrar-sala'); 
});

Route::prefix('servicos')->middleware('autenticacao')->group(function(){
    // Route::get('/', '');
});

Route::middleware('autenticacao')->group(function(){
    Route::get('/download/{idArquivo}', [DownloadController::class, 'baixarArquivoContaBy'])->name('baixarArquivoContaImovel');
});

Route::fallback(function () {
    return redirect()->route('root');
});








