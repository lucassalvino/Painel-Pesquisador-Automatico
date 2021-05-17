<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artigo;
use App\Utils\EnvConfig;
use Illuminate\Http\Request;

class ArtigoController extends Controller{
    public function Cadastra(Request $request){
        return Artigo::CadastraElemento($request);
    }
}