@extends('app.layouts.template-basico')

@section('conteudo')
<h4>Inquilinos ativos: </h4>
      <div>
            <div>
                  @component('app.layouts._components.lista_inquilinos_component',
                  compact('inquilinos_ativos'))
                  @endcomponent
            </div>
      </div>
@endsection

@include('app.scripts.script-listar-inquilinos')