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
use Illuminate\Support\Facades\DB;

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

    private static function Erro($erro){
        DB::rollback();
        return BaseRetornoApi::GetRetornoErro( $erro, 'erros' );
    }
    public function Cadastra(Request $request){
        try{
            DB::beginTransaction();
            $dados = $request->all();
            $artigoid = $dados['artigo_id'];
            $idsCadastros = "";
            $n = count($dados['arestas']);
            for($i = 0; $i<$n; $i++){
                $ret = Vertice::CadastraElementoArray(Array(
                    'descricao' => static::ObtemDescricao($dados['arestas'][$i][0]),
                    'artigo_id' => $artigoid
                ));
                if ( static::HeValidator($ret) ){
                    return static::Erro($ret->errors()->all());
                }
                $idOrigem = $ret;
                $retd = Vertice::CadastraElementoArray(Array(
                    'descricao' => static::ObtemDescricao($dados['arestas'][$i][2]),
                    'artigo_id' => $artigoid
                ));
                if ( static::HeValidator($ret) ){
                    return static::Erro($retd->errors()->all());
                }
                $idDestino = $retd;

                $reta = Aresta::CadastraElementoArray(Array(
                    'descricao' => static::ObtemDescricao($dados['arestas'][$i][1]),
                    'origem_id' => $idOrigem,
                    'destino_id' => $idDestino,
                    'artigo_id' => $artigoid
                ));

                if ( static::HeValidator($reta) ){
                    return static::Erro($reta->errors()->all());
                }else{
                    $idsCadastros = $reta;
                }
            }
            DB::commit();
            $artigo = Artigo::query()
                ->where('id', '=', $artigoid)->first();
                $artigo->processado = true;
                $artigo->save();
            return BaseRetornoApi::GetRetornoSucessoId("Deu certo rapaz", $idsCadastros);

        }catch(Exception $erro){
            Log::info("Erro ao cadastrar entidades");
            Log::error($erro);
            return static::Erro(["Erro ao cadastrar arestas"]);
        }
    }

    public function Busca(Request $request){
        $termo = $request->all()['busca'];
        $DadosExibir = Aresta::query()
            ->leftJoin('vertice as origem', 'origem.id', '=', 'aresta.origem_id')
            ->leftJoin('vertice as destino', 'destino.id', '=', 'aresta.destino_id')
            ->where('aresta.descricao', 'ilike', '%'.$termo.'%')
            ->orWhere('origem.descricao', 'ilike', '%'.$termo.'%')
            ->orWhere('destino.descricao', 'ilike', '%'.$termo.'%')
            ->get([
                'origem.id as origem_id',
                'destino.id as destino_id',
                'origem.descricao as origem',
                'aresta.descricao as conexao',
                'destino.descricao as destino'
            ]);
        return $DadosExibir;
    }
}