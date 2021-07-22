<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artigo;
use App\Utils\ArquivosStorage;
use Illuminate\Http\Request;

class ArtigoController extends Controller{
    public function Cadastra(Request $request){
        return Artigo::CadastraElemento($request);
    }

    public function ObtemArtigoProcessar(Request $request){
        $artigo = Artigo::query()->where('processado', '=', false)->first();
        $artigo['path_arquivo'] = ArquivosStorage::GetUrlView($artigo['path_arquivo']);
        return $artigo;
    }
}