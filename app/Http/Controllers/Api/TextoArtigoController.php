<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TextoArtigo;
use Illuminate\Http\Request;

class TextoArtigoController extends Controller{

    public function Cadastra(Request $request){
        return TextoArtigo::CadastraElemento($request);
    }

}