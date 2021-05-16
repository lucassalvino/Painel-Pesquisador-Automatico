@extends('layouts.admin')
@section('title', 'Política de privacidade')

@section('content')

<div class="d-flex flex-column">
    <h1>Política de Privacidade</h1>
    <h3>Dados de usuário</h3>
    <p>
        Os dados de usuários coletados são somente os dados explicitamente informados pelo próprio usuário
        nos formulários do sistema.
    </p>
    <p>
        Os dados são utilizados somente para validações de login e para possíveis auditorias de dados (artigos inputados).
        E-mails serão enviados para as seguintes situações:
    </p>
    <ul>
        <li>Recuperação de senha</li>
        <li>Processamento de artigo adicionado</li>
        <li>Pesquisa customizada</li>
    </ul>
    <p>
        Caso queira que os dados pessoais sejam apagados da plataforma, solicitar a deleção via e-mail (lucassalvino1@gmail.com) com assunto 'REMOÇÃO DE USUÁRIO', favor informar o e-mail utilizado para login do usuário
    </p>


    <h3>Cookies</h3>
    <p>
        Utilizados para aramazenamento de sessão de usuário. Serão apagados na realização de um novo login
        ou quando o usuário permanecer inativo por 120 minutos
    </p>

    <h3>Artigos</h3>
    <p>
        Não nos responsabilizamos pelos artigos fornecidos no sistema. Caso seja informado um artigo privado 
        será de total responsabilidade do usuário que fez o upload do artigo.
    </p>
    <p>
        Artigos manuais são assumidos como autoria do usuário que o escreve. Sendo de responsabilidade do mesmo sobre o conteúdo manualmente informado.
    </p>
</div>


@stop