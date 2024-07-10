@extends('app.layouts.template-basico')

@section('conteudo')
@include('app.layouts._partials.simple-modal')
@include('app.layouts._partials.spinner')
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
<div class="row">
      <div class="whitespace-end-page"></div>
</div>

@endsection

@section('scripts')
      <script src="{{ asset('js/views/dados-inquilino.js')}}" type="module"></script>
      @include('app.scripts.script-lista-comprovantes')
      @include('app.scripts.script-mensagem')
      @include('app.scripts.script-app-data')
@endsection