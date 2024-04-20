@extends('app.layouts.template-basico')

@section('conteudo')
      <div class="row">
            @component('app.layouts._components.lista_imoveis_component',
            compact('imoveis'))
            @endcomponent
      </div>
@endsection