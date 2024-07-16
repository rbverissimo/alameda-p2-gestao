@extends('app.layouts.template-basico')

@section('conteudo')

@include('app.layouts._partials.crud-header')
<h4>Declare um comprovante </h4>
      @component('app.layouts._components.form_comprovantes_transf',
                  compact('inquilinos', 'tipos_comprovantes', 'comprovante', 'imoveis'))
      @endcomponent
      <div class="row">
            <div class="whitespace-end-page"></div>
      </div>            
@endsection

@section('scripts')
      <script src="{{ asset('js/views/cadastro-comprovantes.js')}}" type="module"></script>
      @include('app.scripts.script-mensagem')
@endsection