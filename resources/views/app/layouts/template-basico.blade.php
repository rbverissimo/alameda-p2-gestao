<!DOCTYPE html>
<html lang="pt-br">
      <head>
            <title>{{$titulo}}</title>
            <meta charset="utf-8">
            <link href="{{asset('css/styles.css')}}" rel="stylesheet">
      </head>
      <body>
            @include('app.layouts._partials.topo-nav')
            @include('app.layouts._partials.mensagens')
            @yield('conteudo')
            @yield('scripts')
      </body>
      <script src="{{ asset('js/scripts.js') }}"></script>
</html>