<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BasePesquisa;
use Illuminate\Http\Request;

class BasePesquisaController extends Controller{
    public function Cadastra(Request $request){
        return BasePesquisa::CadastraElemento($request);
    }
}