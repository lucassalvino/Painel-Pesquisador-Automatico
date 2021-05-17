<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Bases\BaseModelAuthenticatable;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Utils\ArquivosStorage;
use App\Utils\EnvConfig;

class User extends BaseModelAuthenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'path_avatar',
        'cadastro_aprovado'
    ];
    public function GetLikeFields(){
        return [
            'name', 'email'
        ];
    }

    public function GetValidadorCadastro($request){
        $valida = [
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email',
            'password' => 'required|max:128',
            'path_avatar' => 'required|max:300',
        ];
        return $valida;
    }

    public static function CadastraElementoArray($dados){
        $temarquivo = false;
        if(array_key_exists( 'avatar_base64',$dados) && array_key_exists('avatar_tipo', $dados)){
            $dados['path_avatar'] = static::SalvaImagem($dados['avatar_base64'], $dados['avatar_tipo']);
            $temarquivo = $dados['path_avatar'];
        }
        if(array_key_exists('password',$dados)){
            $dados['password'] = hash(EnvConfig::HashSenha(), $dados['password']);
        }
        $retorno = parent::CadastraElementoArray($dados);
        if(!static::CheckIfIsValidator($retorno)){
            UltimosEventos::CadastraEvento("Novo usuário Cadastrado", "O usuário ".$dados['name']." se cadastrou na plataforma.");
        }else{
            if($temarquivo)
                ArquivosStorage::DeletaArquivo($temarquivo);
        }
        return $retorno;
    }

    public function GetValidadorAtualizacao($request, $id){
        $valida = [
            'name' => [ 'required', 'max:255' ],
            'email' => [ 'required', 'max:150', Rule::unique('users')->ignore($id) ],
        ];
        return $valida;
    }

    public static function ListagemElemento(Request $request){
        $retorno = parent::ListagemElemento($request);
        $retorno->getCollection()->transform(function ($value) {
            $value['path_avatar'] = ArquivosStorage::GetUrlView($value['path_avatar']);
            return $value;
        });
        return $retorno;
    }
}
