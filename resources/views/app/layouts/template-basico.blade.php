<!DOCTYPE html>
<html lang="pt-br">
      <head>
            <title>{{$titulo}}</title>
            <meta charset="utf-8">
            <link href="{{asset('css/styles.css')}}" rel="stylesheet">
      </head>
      <body>
            @include('app.layouts._partials.topo-nav')
            @yield('conteudo')
            @yield('scripts')
      </body>
</html>