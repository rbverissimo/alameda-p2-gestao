@extends('app.layouts.template-basico')

@section('conteudo')

<div class="dashboard light-dashboard">
      <div class="row">
          <div onclick="navigateToLastRoute()" class="col-2">
              <button class="button common-button">
                  Voltar</button>
          </div>
      </div>
</div>
<div class="dashboard light-dashboard">
      <div>
            @component('app.layouts._components.form_contas', 
                  compact('conta_imovel', 'imoveis', 'mensagem'))
            @endcomponent
      </div>
</div>
@if (isset($contas_inquilino_associadas[0]))
      <div class="dashboard light-dashboard">
            <div class="divisor-header secondary-divisor">Contas de inquilinos associadas à esta</div>
            <div class="row">
                  <div class="col-12">
                        @component('app.layouts._components.lista_contas_inquilino', ['contas' => $contas_inquilino_associadas])
                            
                        @endcomponent
                  </div>
            </div>
      </div>
@endif
<div class="row">
      <div class="whitespace-end-page"></div>
</div>
@endsection

@section('scripts')
    <script type="module" src="{{ asset('js/views/dados-conta-imovel.js')}}"></script>
@endsection
