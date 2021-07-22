<?php
namespace App\Models;

use App\Models\Bases\BaseModel;
use Illuminate\Database\Eloquent\Model;

Class Vertice extends BaseModel{
    protected $table = 'vertice';
    protected $fillable = [
        'id', 'descricao', 'artigo_id', 'tipo'
    ];

    public function GetLikeFields(){
        return [
            'descricao'
        ];
    }

    public function GetValidadorCadastro($request){
        return [
            'artigo_id' => 'required'
        ];
    }

    public function GetValidadorAtualizacao($request, $id){
        return $this->GetValidadorCadastro($request);
    }

    public function UpdateRegistro($request, Model &$item) {
        $item->descricao = $request['descricao'];
    }

    public static function CadastraElementoArray($dados){
        if(array_key_exists('artigo_id', $dados) && array_key_exists('descricao', $dados)){
            $descricao = $dados['descricao'];
            if(is_null($descricao))
                $descricao = '';
            $vertice = static::query()
                ->where('artigo_id', '=', $dados['artigo_id'])
                ->where('descricao', 'ilike', $descricao)
                ->first();
            if($vertice){
                return $vertice->id;
            }
        }
        return parent::CadastraElementoArray($dados);
    }
}