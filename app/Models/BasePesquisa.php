<?php
namespace App\Models;

use App\Models\Bases\BaseModel;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;

Class BasePesquisa extends BaseModel{
    protected $table = 'base_pesquisa';
    protected $fillable = [
        'id', 'descricao'
    ];

    public function GetLikeFields(){
        return [
            'descricao'
        ];
    }

    public function GetValidadorCadastro($request){
        return ['descricao' => 'required|unique:base_pesquisa|max:300'];
    }

    public function GetValidadorAtualizacao($request, $id){
        return [
            'descricao' => [ 'required', 'max:300', Rule::unique('base_pesquisa')->ignore($id) ]
        ];
    }

    public function UpdateRegistro($request, Model &$item) {
        $item->descricao = $request['descricao'];
    }
}