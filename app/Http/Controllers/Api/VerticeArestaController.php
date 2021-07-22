<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Aresta;
use App\Models\Vertice;
use App\Models\Artigo;
use App\Utils\BaseRetornoApi;
use Exception;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\Log;

class VerticeArestaController extends Controller{

    private static function HeValidator($value){
        return ($value instanceof ValidationValidator);
    }

    private static function ObtemDescricao($value){
        $descricao = $value;
        if(is_null($descricao))
            $descricao = '';
        return $descricao;
    }

    public function Cadastra(Request $request){
        try{
            $dados = $request->all();
            $artigoid = $dados['artigo_id'];
            $n = count($dados['arestas']);
            for($i = 0; $i<$n; $i++){
                $ret = Vertice::CadastraElementoArray(Array(
                    'descricao' => static::ObtemDescricao($dados['arestas'][$i][0]),
                    'artigo_id' => $artigoid
                ));
                if ( static::HeValidator($ret) ){
                    return BaseRetornoApi::GetRetornoErro( $ret->errors()->all(), 'origem' );
                }
                $idOrigem = $ret;
                $ret = Vertice::CadastraElementoArray(Array(
                    'descricao' => static::ObtemDescricao($dados['arestas'][$i][2]),
                    'artigo_id' => $artigoid
                ));
                if ( static::HeValidator($ret) ){
                    return BaseRetornoApi::GetRetornoErro( $ret->errors()->all(), 'destino' );
                }
                $idDestino = $ret;
                $ret = Aresta::CadastraElementoArray(Array(
                    'descricao' => static::ObtemDescricao($dados['arestas'][$i][1]),
                    'origem_id' => $idOrigem,
                    'destino_id' => $idDestino,
                    'artigo_id' => $artigoid
                ));
                if ( static::HeValidator($ret) ){
                    return BaseRetornoApi::GetRetornoErro( $ret->errors()->all(), 'destino' );
                }else{
                    $artigo = Artigo::query()
                    ->where('id', '=', $artigoid)->first();
                    $artigo->processado = true;
                    $artigo->save();
                    return BaseRetornoApi::GetRetornoSucessoId("Deu certo rapaz", $ret);
                }
            }
        }catch(Exception $erro){
            Log::info("Erro ao cadastrar entidades");
            Log::error($erro);
            return BaseRetornoApi::GetRetornoErro(["Erro ao cadastrar arestas"]);
        }
    }

    public function Busca(Request $request){
        $termo = $request->all()['busca'];
        $consulta = Aresta::query()
            ->join('vertice as origem', 'origem.id', '=', 'aresta.origem_id')
            ->join('vertice as destino', 'destino.id', '=', 'aresta.destino_id')
            ->where('aresta.descricao', 'ilike', '%'.$termo.'%')
            ->orWhere('origem.descricao', 'ilike', '%'.$termo.'%')
            ->orWhere('destino.descricao', 'ilike', '%'.$termo.'%')->get(
                [
                    'origem.descricao as origem',
                    'aresta.descricao as conexao',
                    'destino.descricao as destino'
                ]
            );
        return $consulta;
    }
}