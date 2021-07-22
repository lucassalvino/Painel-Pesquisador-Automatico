<?php
namespace App\Models;

use App\Models\Bases\BaseModel;
use Illuminate\Database\Eloquent\Model;

Class TextoArtigo extends BaseModel{
    protected $table = 'texto_artigo';
    protected $fillable = [
        'id', 'texto_extraido', 'artigo_id'
    ];

    public function GetLikeFields(){
        return [
            'texto_extraido'
        ];
    }

    public function GetValidadorCadastro($request){
        return [
            'texto_extraido' => 'required',
            'artigo_id' => 'required'
        ];
    }

    public function GetValidadorAtualizacao($request, $id){
        return $this->GetValidadorCadastro($request);
    }

    public function UpdateRegistro($request, Model &$item) {
        $item->texto_extraido = $request['texto_extraido'];
        $item->artigo_id = $request['artigo_id'];
    }

    public static function CadastraElementoArray($dados){
        if(array_key_exists('artigo_id', $dados) && array_key_exists('texto_extraido', $dados)){
            $texto = static::query()->where('artigo_id', '=', $dados['artigo_id'])->first();
            if($texto){
                $texto->texto_extraido = $dados['texto_extraido'];
                $texto->save();
                return $texto->id;
            }
        }
        return parent::CadastraElementoArray($dados);
    }
}