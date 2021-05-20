<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
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
    return redirect()->route('pagina.login');
});


Route::get('/login', [LoginController::class, 'index'])->name('pagina.login');
Route::post('/login', [LoginController::class, 'doLogin'])->name('fazer.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('fazer.logout');
Route::post('/cadastrausuario', [LoginController::class, 'CadastroUsuario'])->name('cadastroUsuario');

Route::group([
    'prefix' => '/admin',
    'middleware' => 'CheckLoginAdministrativo',
    'as' => 'admin:'
], function(){
    Route::get('/', [AdminController::class, 'index'])->name('home');
    Route::get('/politica-privacidade', [AdminController::class, 'Politica'])->name('politica');
    Route::get('/sobre', [AdminController::class, 'Sobre'])->name('sobre');
    Route::get('/cadastroartigoexterno', [AdminController::class, 'CadastroArtigoExterno'])->name('cadastro_artigos_externos');
    Route::get('/pesquisagrafo', [AdminController::class, 'PesquisaEmGrafo'])->name('pesquisagrafo');
    Route::get('/emconstrucao', [AdminController::class, 'EmConstrucao'])->name('construindo');
});