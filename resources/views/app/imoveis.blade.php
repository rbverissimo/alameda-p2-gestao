@extends('app.layouts.template-basico')

@section('conteudo')
      <div class="row">
            <div class="col-12">
                  @component('app.layouts._components.lista_imoveis_component',
                  compact('imoveis'))
                  @endcomponent
            </div>
      </div>
@endsection