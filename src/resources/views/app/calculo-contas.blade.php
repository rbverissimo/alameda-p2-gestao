@extends('app.layouts.template-basico')

@section('conteudo')

@include('app.layouts._partials.crud-header')
<h4>Declare as contas e o mês de referência: </h4>
      <div>
            <div>
                  @if (isset($conta_imovel))
                        @component('app.layouts._components.form_contas', 
                              compact('tipos_contas', 'tipos_salas', 'conta_imovel', 'imoveis', 'mensagem'))
                        @endcomponent
                  @else    
                        @component('app.layouts._components.form_contas', 
                              compact('tipos_contas', 'tipos_salas', 'imoveis', 'mensagem'))
                        @endcomponent
                  @endif
            </div>
      </div>
@endsection

@include('app.scripts.script-contas')
