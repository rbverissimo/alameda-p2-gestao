<!DOCTYPE html>
<html lang="pt-br">
      <head>
            <title>{{$titulo}}</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="{{asset('css/styles.css')}}" rel="stylesheet">
            <link href="{{asset('css/buttons.css')}}" rel="stylesheet">
            <link href="{{asset('css/cards.css')}}" rel="stylesheet">
      </head>
      <body>
            @include('app.layouts._partials.topo-nav')
            @include('app.layouts._partials.mensagens')
            <div class="conteudo-wrapper">
                  @yield('conteudo')
            </div>
            @include('app.layouts._partials.footer')
            @yield('scripts')
      </body>
      <script type="module" src="{{ asset('js/scripts.js') }}"></script>
</html>