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

Route::middleware('autenticacao')->get('/inquilino/{id}', [PainelInquilinoController::class, 'painel_inquilino'])->name('painel-inquilino');



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

Route::middleware('autenticacao')->controller(ImoveisController::class)->group(function(){
    Route::get('/imoveis', 'index')->name('imoveis');
    Route::get('/imoveis/{id}', 'detalharImovel')->name('imoveis-detalhar');
    Route::get('/imoveis/listar-contas/{id}', 'listarContas')->name('imoveis-listar-contas');
});

Route::middleware('autenticacao')->group(function(){
    Route::get('/download/{idArquivo}', [DownloadController::class, 'baixarArquivoContaBy'])->name('baixarArquivoContaImovel');
});

Route::fallback(function () {
    return redirect()->route('root');
});








