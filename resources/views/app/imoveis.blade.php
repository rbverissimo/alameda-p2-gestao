@extends('app.layouts.template-basico')

@section('conteudo')
      <div class="dashboard light-dashboard">
            <div class="row">
                  <div class="col-3">
                        <button onclick="redirecionarPara('{{ route('cadastrar-imovel')}}')" class="button common-button" >
                              Cadastrar novo imóvel
                        </button>
                  </div>
            </div>
      </div>
      <div class="row">
            @component('app.layouts._components.lista_imoveis_component',
            compact('imoveis'))
            @endcomponent
      </div>
@endsection