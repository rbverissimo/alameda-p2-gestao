<?php

use App\Http\Controllers\CalculoContasController;
use App\Http\Controllers\ComprovantesTransferenciaController;
use App\Http\Controllers\ListaInquilinosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PainelInquilinoController;
use App\Http\Controllers\PainelPrincipalController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(LoginController::class)->group(function(){
    Route::get('/login', 'index')->name('login');
});

Route::get('/painel-principal', [PainelPrincipalController::class, 'index'])
    ->name('painel-principal');

Route::get('/listar-inquilinos', [ListaInquilinosController::class, 'lista'])->name('listar-inquilinos');


Route::controller(CalculoContasController::class)->group(function(){
    Route::get('/calculo-contas', 'calculoContas')
    ->name('calculo-contas');
    Route::post('/calculo-contas', 'calculoContas')
    ->name('calculo-contas');
});

Route::get('/inquilino/{id}', [PainelInquilinoController::class, 'painel_inquilino'])->name('painel-inquilino');



Route::controller(ComprovantesTransferenciaController::class)->group(function(){
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

Route::fallback(function () {
    return redirect()->route('painel-principal');
});








