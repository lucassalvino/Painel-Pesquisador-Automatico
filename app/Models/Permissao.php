<?php
namespace App\Models;

use App\Models\Bases\BaseModel;

Class Permissao extends BaseModel{
    protected $table = 'permissao';
    protected $fillable = [
        'id', 'entidade', 'acao'
    ];

    public function GetValidadorCadastro($request){
        return [
            'entidade' => 'required|max:100',
            'acao' => 'required|max:150'
        ];
    }
}