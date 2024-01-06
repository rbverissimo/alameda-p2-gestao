@extends('app.layouts.template-basico')

@section('conteudo')

<div>
      @component('app.layouts._components.dados_inquilino', compact('inquilino'))
      @endcomponent
</div>
<div>
      <button onclick="carregarComprovantes()" type="button">Ver comprovantes</button>
      <button type="button">Ver situação financeira mensal</button>
</div>
<div id="show">
      <span></span>
</div>

@endsection

@include('app.scripts.script-lista-comprovantes')