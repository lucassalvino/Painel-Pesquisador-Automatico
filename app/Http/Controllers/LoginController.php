<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Utils\BaseRetornoApi;
use Illuminate\Http\Request;

class LoginController extends Controller{

    public function index(){
        return view('login');
    }

    public function doLogin(Request $request){
        $login = Login::Login($request);
        if($login->original[BaseRetornoApi::$CampoErro]){
            return view('login', Array('retorno'=>$login->original));
        }else{
            $request->session()->put('Authorization', $login->original['api_token']);
            $request->session()->put('usuario', $login->original['name']);
            $request->session()->put('pathavatar', $login->original['path_avatar']);
            return redirect()->route('admin:home');
        }
    }
     
    public function logout(Request $request){
        $token = session('Authorization', '');
        Login::LogoutToken($token);
        $request->session()->forget(['Authorization', 'usuario', 'pathavatar']);
        return response()->json([
            'url' => route('pagina.login')
        ]);
    }
    
    public function RealizaLogin(Request $request){
        return Login::Login($request);
    }

    public function CadastroUsuario(Request $request){

    }
}