<?php
namespace App\Models;

use App\Models\Bases\BaseModel;
use Illuminate\Http\Request;
use App\Utils\ArquivosStorage;
use App\Utils\AuxCarbon;

Class Artigo extends BaseModel{
    protected $table = 'artigo_externos';

    protected $fillable = [
        'id', 'titulo', 'path_arquivo', 'ano', 'idioma_id',
        'usuario_id', 'processado', 'autor', 'doi', 'base_pesquisa_id'
    ];

    public function GetLikeFields(){
        return [
            'titulo'
        ];
    }

    public function GetValidadorCadastro($request){
        $valida = [
            'titulo' => 'required|max:500',
            'path_arquivo' => 'required|max:300',
            'ano' => 'required|integer',
            'processado' => 'boolean',
            'autor' => 'max:300',
            'doi' => 'max:300|unique:artigo_externos'
        ];
        return $valida;
    }

    public static function CadastraElementoArray($dados){
        if(array_key_exists('sessao', $dados)){
            $dados['usuario_id'] = $dados['sessao']['user_id'];
        }
        $temarquivo = false;
        if(array_key_exists('arquivo_base_64', $dados) && array_key_exists('arquivo_tipo', $dados)){
            $dados['path_arquivo'] = static::SalvaImagem($dados['arquivo_base_64'], $dados['arquivo_tipo']);
            $temarquivo = $dados['path_arquivo'];
        }
        $retorno = parent::CadastraElementoArray($dados);
        if(!static::CheckIfIsValidator($retorno)){
            UltimosEventos::CadastraEvento('Novo artigo cadastrado', 'O artigo ['.$dados['titulo'].'] acaba de ser cadastrado');
        }else{
            if($temarquivo)
                ArquivosStorage::DeletaArquivo($temarquivo);
        }
        return $retorno;
    }

    public function GetValidadorAtualizacao($request, $id){
        return $this->GetValidadorCadastro($request);
    }

    public static function GetStatisticasHome(){
        $numeroArtigos = static::query()->count();
        $numeroArtigosPendentes = static::query()->where('processado', '=', false)->count();
        $numeroVertices = Vertice::query()->count();
        $DataUltimo = Aresta::query()->orderBy('created_at', 'desc')->first(['created_at']);
        if(!$DataUltimo){
            $DataUltimo = "00/00/0000";
        }else{
            $DataUltimo = $DataUltimo->created_at->format('d/m/Y');
        }
        return Array(
            'artigos'=>$numeroArtigos,
            'pendentes'=>$numeroArtigosPendentes,
            'vertices' =>  $numeroVertices,
            'ultimo' => $DataUltimo
        );
    }

    public static function ListagemElemento(Request $request){
        $retorno = parent::ListagemElemento($request);
        $retorno->getCollection()->transform(function ($value) {
            $value['path_arquivo'] = ArquivosStorage::GetUrlView($value['path_arquivo']);
            $value['data'] = AuxCarbon::GetDateTimeString($value['created_at'], 'd/m/Y H:i');
            return $value;
        });
        return $retorno;
    }
}