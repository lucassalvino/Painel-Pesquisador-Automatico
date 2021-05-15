<!doctype html>
<html lang="pt-BR">
  <head>
    @include('includes.default-head')
  </head>
<body>
    <div class="fundo-body" style="background-image: url({{ asset('assets/images/fundo-lupa.png')}})">
        @yield('content')
    </div>
</body>
</html>