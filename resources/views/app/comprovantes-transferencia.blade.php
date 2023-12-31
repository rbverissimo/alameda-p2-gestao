@extends('app.layouts.template-basico')

@section('conteudo')
<div>
      <a href="{{ route('painel-principal') }}">Voltar</a>
</div>
<h4>Declare um comprovante </h4>
      <div>
            <div>
                  @component('app.layouts._components.form_comprovantes_transf',
                  compact('inquilinos', 'tipos_comprovantes'))
                  @endcomponent
            </div>
      </div>
@endsection