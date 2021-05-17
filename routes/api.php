<?php

use App\Http\Controllers\Api\ArtigoController;
use App\Http\Controllers\Api\UsuarioController;
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
});

Route::namespace('Api')->middleware(['cors','VerificaSessao'])->group(function(){
    Route::prefix('/artigo')->group(function(){
        Route::post('/', [ArtigoController::class, 'Cadastra'])->name('cadastra-artigo');
    });
});