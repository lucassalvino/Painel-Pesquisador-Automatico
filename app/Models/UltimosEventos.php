<?php
namespace App\Models;

use App\Models\Bases\BaseModel;
use App\Utils\AuxCarbon;
use Exception;
use Illuminate\Support\Facades\Log;

Class UltimosEventos extends BaseModel{
    private static $numeroView = 10;

    protected $table = 'ultimos_eventos';
    protected $fillable = [
        'id', 'titulo', 'descricao'
    ];

    public static function CadastraEvento($titulo, $descricao){
        try{
            UltimosEventos::create(Array(
                'titulo' => $titulo,
                'descricao' => $descricao
            ));
        }catch(Exception $erro){
            Log::error($erro);
        }
    }

    public static function GetEventosView(){
        $retorno = static::query()->orderBy('created_at', 'DESC')->take(static::$numeroView)->get()->toArray();
        $n = count($retorno);
        for($i = 0; $i<$n;$i++){
            $retorno[$i]['data'] = AuxCarbon::GetDateTimeString($retorno[$i]['created_at']);
        }
        return $retorno;
    }
}