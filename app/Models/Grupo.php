<?php
namespace App\Models;

use App\Models\Bases\BaseModel;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;

Class Grupo extends BaseModel{
    protected $table = 'grupo';
    protected $fillable = [
        'id', 'nome'
    ];

    public function GetLikeFields(){
        return [
            'nome'
        ];
    }

    public function GetValidadorCadastro($request){
        return ['nome' => 'required|unique:grupo|max:255'];
    }

    public function GetValidadorAtualizacao($request, $id){
        return [
            'nome' => [ 'required', 'max:255', Rule::unique('grupo')->ignore($id) ]
        ];
    }

    public function UpdateRegistro($request, Model &$item) {
        $item->nome = $request['nome'];
    }
}