@extends('app.layouts.template-basico')

@section('conteudo')

<div class="row">
      @component('app.layouts._components.dados_inquilino', compact('inquilino'))
      @endcomponent
</div>
<div class="row">
      <div class="col-3">
            <button class="button common-button" onclick="carregarComprovantes()" type="button">Comprovantes</button>
      </div>
      <div class="col-3">
            <button class="button common-button" onclick="carregarSituacaoFinanceira()" type="button">Situação financeira</button>
      </div>
</div>

@include('app.layouts._components.lista_comprovantes')

<div class="row">
      @include('app.layouts._components.situacao_financeira_inquilino')
</div>

@endsection

@include('app.scripts.script-lista-comprovantes')