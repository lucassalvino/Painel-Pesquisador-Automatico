<?php
namespace App\Models;

use App\Models\Bases\BaseModel;
use Illuminate\Database\Eloquent\Model;

Class Aresta extends BaseModel{
    protected $table = 'aresta';
    protected $fillable = [
        'id', 'descricao', 'origem_id', 'destino_id', 'artigo_id', 'tipo'
    ];

    public function GetLikeFields(){
        return [
            'descricao'
        ];
    }

    public function GetValidadorCadastro($request){
        return [
            'artigo_id' => 'required',
            'destino_id' => 'required',
            'origem_id' => 'required'
        ];
    }

    public function GetValidadorAtualizacao($request, $id){
        return $this->GetValidadorCadastro($request);
    }

    public function UpdateRegistro($request, Model &$item) {
        $item->descricao = $request['descricao'];
    }

    public static function CadastraElementoArray($dados){
        if(
            array_key_exists('artigo_id', $dados) &&
            array_key_exists('descricao', $dados) &&
            array_key_exists('origem_id', $dados) &&
            array_key_exists('destino_id', $dados)
            ){
            $descricao = $dados['descricao'];
            if(is_null($descricao))
                $descricao = '';
            $aresta = static::query()
                ->where('artigo_id', '=', $dados['artigo_id'])
                ->where('origem_id', '=', $dados['origem_id'])
                ->where('destino_id', '=', $dados['destino_id'])
                ->where('descricao', 'ilike', $descricao)
                ->first();
            if($aresta){
                return $aresta->id;
            }
        }
        return parent::CadastraElementoArray($dados);
    }
}