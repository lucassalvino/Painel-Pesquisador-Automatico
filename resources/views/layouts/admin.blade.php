<!doctype html>
<html lang="pt-BR">

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
          <a href="#">Pesquisador</a>
          <div id="close-sidebar">
            <i class="fas fa-times"></i>
          </div>
        </div>
        <div class="sidebar-header">
          <div class="user-pic">
            <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg" alt="User picture">
          </div>
          <div class="user-info">
            <span class="user-name">Jhon
              <strong>Smith</strong>
            </span>
            <span class="user-role">Administrator</span>
            <span class="user-status">
              <i class="fa fa-circle"></i>
              <span>Online</span>
            </span>
          </div>
        </div>
        <!-- sidebar-search  -->

        <!--  EXEMPLO DROPDOWN
         <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-shopping-cart"></i>
              <span>E-commerce</span>
              <span class="badge badge-pill badge-danger">3</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="#">Products

                  </a>
                </li>
                <li>
                  <a href="#">Orders</a>
                </li>
                <li>
                  <a href="#">Credit cart</a>
                </li>
              </ul>
            </div>
          </li>
      -->
        <div class="sidebar-menu">
          <ul>
            <li class="header-menu">
              <span>Geral</span>
            </li>

            <li>
              <a href="#">
                <i class="fas fa-search"></i>
                <span>Pesquisa em grafo</span>
                <span class="badge badge-pill badge-danger">Alfa</span>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fas fa-search-plus"></i>
                <span>Pesquisa inteligente</span>
                <span class="badge badge-pill badge-danger">Alfa</span>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="far fa-newspaper"></i>
                <span>Cadastro de artigo</span>
                <span class="badge badge-pill badge-danger">Alfa</span>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fas fa-text-width"></i>
                <span>Artigo Manual</span>
                <span class="badge badge-pill badge-danger">Alfa</span>
              </a>
            </li>

            <li class="header-menu">
              <span>Admin</span>
            </li>
            <li>
              <a href="#">
                <i class="fas fa-users"></i>
                <span>Usuários</span>
                <span class="badge badge-pill badge-danger">Alfa</span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fas fa-tools"></i>
                <span>Configurações</span>
                <span class="badge badge-pill badge-danger">Alfa</span>
              </a>
            </li>
            <li class="header-menu">
              <span>Sobre</span>
            </li>
            <li>
              <a href="#">
                <i class="fas fa-address-card"></i>
                <span>Sobre</span>
                <span class="badge badge-pill badge-danger">Alfa</span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fas fa-balance-scale"></i>
                <span>Política de privacidade</span>
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
        <a href="#">
          <i class="fa fa-power-off"></i>
        </a>
      </div>
    </nav>

    <!-- sidebar-wrapper  -->
    <main class="page-content">
      <div class="container-fluid">

        @yield('content')

        <hr>
        <footer class="text-center">
          <div class="mb-2">
            <small class="d-flex justify-content-center align-items-center">
              © &nbsp; <i class="fab fa-github" style="font-size: 15px;"></i> &nbsp; <a target="_blank" rel="noopener noreferrer" href="https://github.com/lucassalvino/Painel-Pesquisador-Automatico">
                Repositório GitHub
              </a>
            </small>
          </div>
        </footer>

      </div>
    </main>
    <!-- page-content" -->
  </div>
</body>

</html>