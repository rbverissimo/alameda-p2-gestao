<div class="fixed-topo-nav" id="navbar">
      <div class="nav-wrapper">
            <a href="{{ route('painel-principal') }}">Painel</a>
            <a href="{{ route('calculo-contas')}}">Contas</a>
            <a href="{{ route('comprovantes-transferencia') }}">Comprovantes</a>
            <a href="{{ route('imoveis')}}">Imoveis</a>
      </div>
</div>

<script type="module" src="{{ asset('js/topo-nav.js')}}"></script>