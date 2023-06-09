@extends('layouts.fundolupa')
@section('title', 'Login')

@section('content')
<div class="d-flex w-100 h-100 justify-content-center align-items-center">
    <div class="d-flex container-form-login">
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="d-flex">
                <img class="icone-pesquisador" src="{{asset('assets/images/iconfinder-icon.svg')}}" alt="Icone pesquisador">
            </div>
            <div class="d-flex pt-2">
                <h1>
                    LEDORIA
                </h1>
            </div>
            <div class="d-flex justify-content-center align-items-center flex-column pt-4">
               @if(isset($retorno))
                @include('includes.error', ['retorno'=>$retorno])
               @endif
                <form method="POST" action="{{ url('/login') }}" no-process>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" id="usuario" name="user" placeholder="Usuário">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                    </div>
                    <div class="form-check">
                        <div>
                            <input onclick="mostraocultasenha()" type="checkbox" class="form-check-input small" id="mostrarsenha">
                            <label class="form-check-label small" for="mostrarsenha">Mostrar Senha</label>
                        </div>
                    </div>
                    <div class="d-flex pt-4">
                        <button type="submit" id="logar" class="btn btn-primary">Logar</button>
                    </div>
                </form>
                <div class="d-flex w-100 justify-content-end pt-2 pr-2">
                    <a href="#">Esqueci minha senha</a>
                    <a class="pl-3" href="#" data-toggle="modal" data-target="#modalcadastro">Criar Conta</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalcadastro" tabindex="-1" role="dialog" aria-labelledby="modalcadastroLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content pb-3">
      <div class="d-flex justify-content-between align-items-center pl-2 pr-2 pt-2">
        <h5 class="modal-title" id="modalcadastroLabel">Cadastro de novo usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{route('cadastro-usuario')}}" method="POST" enctype="multipart/form-data" data-onsubmit data-back>
        <div class="d-flex flex-column pl-3 pr-3 pt-4">
            <div class="d-flex justify-content-center">
                <div class="form-group">
                    <label class="">Seu Avatar</label>
                    <img class="box-photo btn-photo img-fluid d-none d-md-block mb-2" src="{{ asset('assets/images/camera.svg') }}" width="168" height="168"> 
                    <input type="file" class="d-md-none mb-md-0 mb-3" accept="image/*" id="file-photo" required>
                    <input type="hidden" name="avatar_base64" id="path-photo">
                    <input type="hidden" name="avatar_tipo" id="type-photo">
                    <label class="btn-photo d-none d-md-block">
                        <i class="fas fa-file-upload"></i> Upload da imagem
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
            </div>
            <div class="d-flex w-100">
                <div class="w-50 form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="name" class="form-control" id="nome" placeholder="Nome" required>
                </div>
                <div class="w-50 form-group ml-2">
                    <label for="senha">Senha</label>
                    <input type="password" name="password" class="form-control" id="senha" placeholder="senha" required>
                </div>
            </div>
            <div class="d-flex w-100 justify-content-end">
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary"> Solicitar Cadastro </button>
                </div>
            </div>
        </div>
      </form>

    </div>
  </div>
</div>

<script>
    function mostraocultasenha(){
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    
</script>
@stop