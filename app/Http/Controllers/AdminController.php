<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Artigo;
use App\Models\Idioma;
use App\Models\Login;
use App\Models\UltimosEventos;
use App\Models\User;
use App\Utils\BaseRetornoApi;
use Illuminate\Http\Request;

class AdminController extends Controller{

    public function index(){
        $eventos = UltimosEventos::GetEventosView();
        $homeartigos = Artigo::GetStatisticasHome();
        return view('pages.home', compact("eventos", "homeartigos"));
    }
    public function Politica(){
        return view ('pages.politica');
    }
    public function Sobre(){
        return view ('pages.sobre');
    }
    public function EmConstrucao(){
        return view ('pages.emconstrucao');
    }
    public function CadastroArtigoExterno(Request $request){
        $idiomas = Idioma::query()->get();
        $artigos = Artigo::ListagemElemento($request);
        return view ('pages.artigosexterno', compact('idiomas', 'artigos'));
    }
    public function PesquisaEmGrafo(Request $request){
        return view('pages.pesquisagrafo');
    }
    public function GestaoUsuarios(Request $request){
        $usuarios = User::query()->get();
        return view('pages.usuarios', compact("usuarios"));
    }
}