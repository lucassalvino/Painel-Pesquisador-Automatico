<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\EnvConfig;
use Illuminate\Http\Request;

class UsuarioController extends Controller{
    public function Cadastra(Request $request){
        return User::CadastraElemento($request);
    }
}