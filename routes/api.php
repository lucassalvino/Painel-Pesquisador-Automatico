<?php

use App\Http\Controllers\Api\ArtigoController;
use App\Http\Controllers\Api\BasePesquisaController;
use App\Http\Controllers\Api\EntidadeArtigoController;
use App\Http\Controllers\Api\TextoArtigoController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\VerticeArestaController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->middleware(['cors'])->group(function(){
    Route::prefix('/usuario')->group(function(){
        Route::post('/', [UsuarioController::class, 'Cadastra'])->name('cadastro-usuario');
    });
    Route::prefix('/login')->group(function(){
        Route::post('/', [LoginController::class, 'RealizaLogin'])->name('RealizaLogin');
    });
});

Route::namespace('Api')->middleware(['cors','VerificaSessao'])->group(function(){
    Route::prefix('/artigo')->group(function(){
        Route::get('/artigoProcessar', [ArtigoController::class, 'ObtemArtigoProcessar'])->name('obtem-artigo-processar');
        Route::post('/', [ArtigoController::class, 'Cadastra'])->name('cadastra-artigo');
    });
    Route::prefix('/textoartigo')->group(function(){
        Route::post('/', [TextoArtigoController::class, 'Cadastra'])->name('cadastra-texto-artigo');
    });
    Route::prefix('entidadeartigo')->group(function(){
        Route::post('/', [EntidadeArtigoController::class, 'Cadastra'])->name('cadastra-entidade-artigo');
    });
    Route::prefix('verticearesta')->group(function(){
        Route::post('/busca', [VerticeArestaController::class, 'Busca'])->name('busca-verticearesta-artigo');
        Route::post('/', [VerticeArestaController::class, 'Cadastra'])->name('cadastra-verticearesta-analise-artigo');
    });
    Route::prefix('/basepesquisa')->group(function(){
        Route::post('/', [BasePesquisaController::class, 'Cadastra'])->name('cadastra-base-pesquisa');
    });
});