@extends('app.layouts.template-basico')

@section('conteudo')
<div>
      <a href="{{ route('painel-principal') }}">Voltar</a>
</div>
<h4>Inquilinos ativos: </h4>
      <div>
            <div>
                  @component('app.layouts._components.lista_inquilinos_component',
                  compact('inquilinos_ativos'))
                  @endcomponent
            </div>
      </div>
@endsection