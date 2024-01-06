<?php

use App\Http\Controllers\CalculoContasController;
use App\Http\Controllers\ComprovantesTransferenciaController;
use App\Http\Controllers\ListaInquilinosController;
use App\Http\Controllers\PainelInquilino;
use App\Http\Controllers\PainelInquilinoController;
use App\Http\Controllers\PainelPrincipalController;
use App\Http\Controllers\PessoaController;
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

Route::get('/painel-principal', [PainelPrincipalController::class, 'index'])->name('painel-principal');

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
    Route::get('/comprovantes-transferencia/{id}', 'comprovantesPorInquilino')
    ->name('comprovantes-inquilino');
    Route::post('/comprovantes-transferencia', 'index')
    ->name('comprovantes-transferencia');
});








