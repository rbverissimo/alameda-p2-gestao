@extends('app.layouts.template-basico')

@section('conteudo')

@include('app.layouts._partials.crud-header')
<h4>Declare um comprovante </h4>
      @isset($inquilinos)
      <div class="row">
            <div class="end-page-margin">
                  @component('app.layouts._components.form_comprovantes_transf',
                  compact('inquilinos', 'tipos_comprovantes', 'imoveis'))
                  @endcomponent
            </div>
      </div>
      @endisset

      @isset($comprovante)
      <div class="row">
            <div class="end-page-margin">
                  @component('app.layouts._components.form_comprovantes_transf', 
                  compact('tipos_comprovantes', 'comprovante', 'imoveis'))
                  @endcomponent
            </div>
      </div>
      @endisset
@endsection

@section('scripts')
      <script src="{{ asset('js/views/cadastro-comprovantes.js')}}" type="module"></script>
      @include('app.scripts.script-mensagem')
@endsection