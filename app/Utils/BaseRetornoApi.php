<?php
namespace App\Utils;
class BaseRetornoApi{
    public static $CampoMensagem = 'mensagem';
    public static $MensagensErro = 'mensagenserro';
    public static $CampoErro = 'erro';
    public static $id = 'id';
    public static $codigoRetorno = "codigoretorno";

    public static function GetRetornoSucesso(string $mensagem){
        return self::GeraRetorno($mensagem, false, [], 200);
    }
    public static function GetRetornoSucessoId(string $mensagem, $id){
        return self::GeraRetorno($mensagem, false, [], 200, $id);
    }
    public static function GetRetornoErro(Array $mensagens, string $mensagem = "Um erro inesperado acabou de acontecer", $codigo = 400){
        return self::GeraRetorno($mensagem, true, $mensagens, $codigo);
    }
    public static function GetRetornoNaoAutorizado(string $mensagem){
        return self::GeraRetorno($mensagem, true, [], 401);
    }
    public static function GetRetornoLoginIncorreto(Array $mensagensErro){
        return self::GeraRetorno("Não foi possível realizar login", true, $mensagensErro, 403);
    }

    public static function GetRetornoPostArrayErros(Array $Erros, String $MensagemSucesso){
        if(count($Erros) <= 0)
            return self::GetRetornoSucesso($MensagemSucesso);
        else
            return self::GetRetornoErro($Erros);
    }
    public static function GetRetorno404(string $mensagem, $arraymensagens = []){
        return self::GeraRetorno($mensagem, true, $arraymensagens, 404);
    }
    public static function GetRetornoNaoEncontrado(){
        return response()->json([
            self::$CampoMensagem => "Registro não encontrado",
            self::$CampoErro => true,
            self::$MensagensErro => [],
            self::$id => "",
            self::$codigoRetorno => 404
        ], 404);
    }

    private static function GeraRetorno($mensagem, $erro, $mensagensErro,  $codigoErro, $idRetorno = ""){
        return response()->json([
            self::$CampoMensagem => $mensagem,
            self::$CampoErro => $erro,
            self::$MensagensErro => $mensagensErro,
            self::$id => $idRetorno,
            self::$codigoRetorno => $codigoErro
        ], $codigoErro);
    }
}