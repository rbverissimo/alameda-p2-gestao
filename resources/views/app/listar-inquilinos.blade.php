@extends('app.layouts.template-basico')

@section('conteudo')
@include('app.layouts._partials.topo-lista-inquilinos')
      <div>
            <div>
                  @component('app.layouts._components.lista_inquilinos_component',
                  compact('inquilinos_ativos'))
                  @endcomponent
            </div>
      </div>
@endsection

@include('app.scripts.script-listar-inquilinos')