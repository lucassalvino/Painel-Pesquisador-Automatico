<!doctype html>
<html lang="pt-BR">

<?php

?>

<head>
  @include('includes.default-head')
</head>

<body>
  <div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
      <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
      <div class="sidebar-content">
        <div class="sidebar-brand">
          <a href="{{route('admin:home')}}">LEDORIA</a>
          <div id="close-sidebar">
            <i class="fas fa-times"></i>
          </div>
        </div>
        <div class="sidebar-header">
          <div class="user-pic">
            <img class="img-responsive img-rounded" src="{{ session('pathavatar','') }}" alt="Avatar usuário">
          </div>
          <div class="user-info">
            <span class="user-name">
              {{ session('usuario', '') }}
            </span>
          </div>
        </div>
        <div class="sidebar-menu">
          <ul>
            <li class="header-menu">
              <span>Geral</span>
            </li>

            <li>
              <a href="{{route('admin:pesquisagrafo')}}">
                <i class="fas fa-search"></i>
                <span>Pesquisa em grafo</span>
              </a>
            </li>

            <li>
              <a href="{{route('admin:construindo')}}">
                <i class="fas fa-search-plus"></i>
                <span>Pesquisa inteligente</span>
                <span class="badge badge-pill badge-danger">Alfa</span>
              </a>
            </li>

            <li>
              <a href="{{route('admin:cadastro_artigos_externos')}}">
                <i class="far fa-newspaper"></i>
                <span>Artigos Externos</span>
              </a>
            </li>

            <li>
              <a href="{{route('admin:construindo')}}">
                <i class="fas fa-text-width"></i>
                <span>Artigo Manual</span>
                <span class="badge badge-pill badge-danger">Alfa</span>
              </a>
            </li>
            <li>
              <a href="{{route('admin:basepesquisa')}}">
                <i class="fas fa-database"></i>
                <span>Bases de Pesquisa</span>
              </a>
            </li>
            <li class="header-menu">
              <span>Sobre</span>
            </li>
            <li>
              <a href="{{route('admin:sobre')}}">
                <i class="fas fa-address-card"></i>
                <span>Sobre</span>
                <span class="badge badge-pill badge-primary">Beta</span>
              </a>
            </li>
            <li>
              <a href="{{route('admin:politica')}}">
                <i class="fas fa-balance-scale"></i>
                <span>Pol. de privacidade</span>
                <span class="badge badge-pill badge-primary">Beta</span>
              </a>
            </li>
            </li>
          </ul>
        </div>
        <!--   
        badge-primary : fundo azul
        badge-danger : fundo vermelho
        badge-success: fundo verde
      -->
      </div>

      <!-- sidebar-content  -->
      <div class="sidebar-footer">
        <a href="#">
          <i class="fa fa-bell"></i>
          <span class="badge badge-pill badge-warning notification">0</span>
        </a>
        <a href="#">
          <i class="fa fa-envelope"></i>
          <span class="badge badge-pill badge-success notification">0</span>
        </a>
        <a href="#" data-toggle="modal" data-target="#modallogout">
          <i class="fa fa-power-off"></i>
        </a>
      </div>
    </nav>
    <div class="modal fade" id="modallogout" tabindex="-1" role="dialog" aria-labelledby="modallogoutTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Você realmente quer sair?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Quando fizer logout será necessário logar novamente para ter acesso</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            <button type="button" id="logout" class="btn btn-danger">Logout</button>
          </div>
        </div>
      </div>
    </div>
    <!-- sidebar-wrapper  -->
    <main class="page-content">
      <div class="container-fluid">

        @yield('content')

        <hr>
        <footer class="text-center">
          <div class="mb-2">
            <small class="d-flex justify-content-center align-items-center" style="font-size: 18px;">
              <i class="fab fa-python"></i> &nbsp; <i class="fab fa-laravel"></i> &nbsp; <i class="fab fa-github"></i> &nbsp; <a target="_blank" rel="noopener noreferrer" href="https://github.com/lucassalvino/Painel-Pesquisador-Automatico">
                Repositório GitHub
              </a>
            </small>
          </div>
        </footer>

      </div>
    </main>
    <!-- page-content" -->
  </div>

  <script>
    $('#logout').on('click', function(){
      $.ajax({
        url: '{{route("fazer.logout")}}',
        type: 'POST',
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
        data:{
          "_token": "{{ csrf_token() }}",
        },
        success:function(data){
          window.location.href = data.url;
        }
      });
    });
  </script>
</body>

</html>