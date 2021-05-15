<?php 
namespace App\Models\Bases;

use App\Utils\ArquivosStorage;
use App\Utils\BaseRetornoApi;
use Exception;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
class BaseModel extends Model{
    use SoftDeletes;
    public static $guidempty = "00000000-0000-0000-0000-000000000000";
    protected static function boot(){
        parent::boot();
        static::creating(function ($post) {
            $post->{$post->getKeyName()} = (string) Str::uuid();
        });
    }
    public function getIncrementing(){
        return false;
    }
    public function getKeyType(){
        return 'string';
    }
    public function GetValidadorCadastro($request){
        return [];
    }
    public function GetValidadorAtualizacao($request, $id){
        return [];
    }
    public function ConstruiFiltroListagem(Builder $consulta, Request $request) : Builder{
        return $consulta;
    }
    public function ColunasListagem() : Array{
        return $this->fillable;
    }
    public function GetTableName(){
        return $this->table;
    }
    public function GetLikeFields(){
        return [];
    }
    public function GetMenssagensValidacao(){
        return Array(
            'required' => "O campo ':attribute' é requerido",
            'unique' => "O campo ':attribute' já contem um valor idêntico",
            'exists' => "O ':attribute' não existe na tabela alvo",
            'current_password' => "Senha informada não corresponde a atual",
        );
    }
    public function GeraArrayInsert($request){
        if($request instanceof Request)
            return $request->all();
        return $request;
    }

    public function UpdateRegistro($request, Model &$item){
        return;
    }

    /**
     * Retorna um UUID se cadastro ocorreu com suceso, ou um Validator caso tenha falhado na validação
     */
    public static function CadastraElementoArray($dados){
        $instancia = new static;
        $valida = Validator::make($dados, $instancia->GetValidadorCadastro($dados), $instancia->GetMenssagensValidacao());
        if ($valida->fails()) {
            return $valida;
        }else{
            return self::create(
                $dados
            )->id;
        }
    }

    /**
     * Verifica se o $value é um Validator
     */
    protected static function CheckIfIsValidator($value){
        return ($value instanceof ValidationValidator);
    }

    public static function CadastraElemento(Request $request){
        try{
            $id = static::CadastraElementoArray($request->all());
            if(static::CheckIfIsValidator($id)){
                return BaseRetornoApi::GetRetornoErro($id->errors()->all(), "O registro não foi criado");
            }else{
                if($id instanceof JsonResponse)
                    return $id;
                if($id){
                    return BaseRetornoApi::GetRetornoSucessoId("Registro Criado com sucesso", $id);
                }else{
                    return BaseRetornoApi::GetRetornoErro(Array());
                }
            }
        }
        catch(Exception $erro){
            Log::error($erro);
            return BaseRetornoApi::GetRetornoErro([$erro->getMessage()]);
        }
    }

    public static function AtualizaElementoArray($dados, &$instanciaBanco){
        $instancia = new static;
        $valida = Validator::make($dados, $instancia->GetValidadorAtualizacao($dados, $instanciaBanco->id), $instancia->GetMenssagensValidacao());
        if($valida->fails()){
            return $valida;
        }else{
            $instancia->UpdateRegistro($dados, $instanciaBanco);
            $instanciaBanco->save();
            return true;
        }
    }

    public static function AtualizaElemento(Request $request, $id){
        try{
            $item = static::query()->where('id', '=', $id)->first();
            if($item){
                $atualiza = static::AtualizaElementoArray($request->all(), $item);
                if( static::CheckIfIsValidator($atualiza) ){
                    return BaseRetornoApi::GetRetornoErro($atualiza->errors()->all(), "O registro não foi atualizado");
                }else{
                    return BaseRetornoApi::GetRetornoSucessoId("Registro atualizado com sucesso", $id);
                }
            }else{
                return BaseRetornoApi::GetRetornoNaoEncontrado();
            }
        }
        catch(Exception $erro){
            Log::error($erro);
            return BaseRetornoApi::GetRetornoErro([$erro->getMessage()]);
        }
    }

    protected function MontarConsultaBuscaTexto(&$consulta, $termo){
        $buscaTexto = "%".strtoupper($termo)."%";
        $termos = $this->GetLikeFields();

        $consulta = $consulta->where(function($q) use ($termos, $buscaTexto) {
            foreach($termos as $key=>$termo){
                if($key == 0){
                    $q->where($termo, 'ilike', $buscaTexto);
                }else{
                    $q->orWhere($termo, 'ilike', $buscaTexto);
                }
            }
        });
        return $consulta;
    }

    public static function ListagemElemento(Request $request){
        $instancia = new static;
        $consulta = self::query();
        $incluiExcluidos = false;
        $porpagina = isset($_GET['per_page']) ? intval($_GET['per_page']) : 20;
        if( isset($_GET['with_trashed']) && intval(isset($_GET['with_trashed'])) == 1){
            $consulta = self::withTrashed();
            $incluiExcluidos = true;
        }
        if( isset($_GET['trashed_only']) && intval(isset($_GET['trashed_only'])) == 1){
            $consulta = self::onlyTrashed();
            $incluiExcluidos = true;
        }
        if( isset($_GET['id']) ){
            $consulta = $consulta->where($instancia->GetTableName().'.id','=',$_GET['id']);
        }
        if( isset($_GET['search']) ){
            $instancia->MontarConsultaBuscaTexto($consulta, $_GET['search']);
        }
        $camposRetorno = $instancia->ColunasListagem();
        if($incluiExcluidos){
            array_push($camposRetorno,$instancia->GetTableName().'.deleted_at');
        }
        return $instancia->ConstruiFiltroListagem($consulta, $request)->paginate($porpagina, $camposRetorno);
    }

    public static function DeleteElemento(Request $request, $id){
        $item = self::query()->where('id', '=', $id)->first();
        if($item){
            $item->delete();
            return BaseRetornoApi::GetRetornoSucessoId("Registro movido para lixeira", $id);
        }else{
            return BaseRetornoApi::GetRetornoNaoEncontrado();
        }
    }

    public static function RestoreElemento(Request $request, $id){
        $elemento = self::withTrashed()->where('id', '=', $id)->first();
        if($elemento){
            $elemento->restore();
            return BaseRetornoApi::GetRetornoSucessoId("Registro restaurado com sucesso", $id);
        }else{
            return BaseRetornoApi::GetRetornoNaoEncontrado();
        }
    }
    
    public static function SalvaImagem($base64Imagem, $tipoImagem){
        
        $nomeArquivo = false;

        if(isset($base64Imagem)){
            if(isset($tipoImagem)){
                
                $nomeArquivo = ArquivosStorage::GetRelativePath('imagens', $tipoImagem);
                ArquivosStorage::Base64ParaImagem($base64Imagem, ArquivosStorage::GetPathImagem($nomeArquivo, 'imagens'));

            }else{
                throw "É necessário informar o tipo da imagem.";
            }
        }

        return $nomeArquivo;
    }
}