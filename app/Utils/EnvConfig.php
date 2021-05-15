<?php 
namespace App\Utils;
class EnvConfig{
    
    public static function HashSenha(){
        return env('HASH_SENHA', 'sha512');
    }

    public static function HashTokenApi(){
        return env('HASH_TOKEN_API', 'sha256');
    }

    public static function QtdSessaoPorUsuario(){
        return env('SESSAO_ATIVA_USUARIO', '2');
    }

    public static function ObtemIPInterno(){
        return env('IP_INTERNO','127.0.0.1');
    }
}