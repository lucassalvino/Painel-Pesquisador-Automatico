<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EntidadeArtigo;
use App\Utils\BaseRetornoApi;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;

class EntidadeArtigoController extends Controller{

    public function Cadastra(Request $request){
        $dados = $request->all();
        if(array_key_exists('entidades', $dados) && is_array($dados['entidades']) && array_key_exists('artigo_id', $dados)){
            foreach($dados['entidades'] as $entidade){
                if(!is_null($entidade)){
                    $cadastro = EntidadeArtigo::CadastraElementoArray(Array(
                        'entidade' => $entidade,
                        'artigo_id' => $dados['artigo_id']
                    ));
                    if($cadastro instanceof ValidationValidator){
                        return BaseRetornoApi::GetRetornoErro($cadastro->errors()->all(), "O registro não foi criado");
                    }
                }
            }
            return BaseRetornoApi::GetRetornoSucesso("Entidades Cadastradas com sucesso");
        }else{
            return EntidadeArtigo::CadastraElemento($request);
        }
    }

}