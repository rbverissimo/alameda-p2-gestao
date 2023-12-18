<?php

use App\Http\Controllers\CalculoContasController;
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

Route::get('/calculo-contas', [CalculoContasController::class, 'calculoContas'])
->name('calculo-contas');

Route::post('/calculo-contas', [CalculoContasController::class, 'calculoContas'])
->name('calculo-contas');



