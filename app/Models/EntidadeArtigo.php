<?php
namespace App\Models;

use App\Models\Bases\BaseModel;
use Illuminate\Database\Eloquent\Model;

Class EntidadeArtigo extends BaseModel{
    protected $table = 'entidades_artigo';
    protected $fillable = [
        'id', 'entidade', 'artigo_id'
    ];

    public function GetLikeFields(){
        return [
            'entidade'
        ];
    }

    public function GetValidadorCadastro($request){
        return [
            'entidade' => 'required|max:255',
            'artigo_id' => 'required'
        ];
    }

    public function GetValidadorAtualizacao($request, $id){
        return $this->GetValidadorCadastro($request);
    }

    public function UpdateRegistro($request, Model &$item) {
        $item->entidade = $request['entidade'];
        $item->artigo_id = $request['artigo_id'];
    }

    public static function CadastraElementoArray($dados){
        if(array_key_exists('entidade', $dados)){
            $dados['entidade'] = strtolower($dados['entidade']);
        }
        if(array_key_exists('artigo_id', $dados) && array_key_exists('entidade', $dados)){
            $entidade = static::query()
                ->where('artigo_id', '=', $dados['artigo_id'])
                ->where('entidade', '=', $dados['entidade'])
                ->first();
            if($entidade){
                return $entidade->id;
            }
        }
        return parent::CadastraElementoArray($dados);
    }
}