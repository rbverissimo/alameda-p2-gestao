@extends('app.layouts.template-basico')

@section('conteudo')
<h4>Declare as contas e o mês de referência: </h4>
      <div>
            <div>
                  @component('app.layouts._components.form_contas', compact('tipos_contas', 'tipos_salas'))
                  @endcomponent
            </div>
      </div>
@endsection

@include('app.scripts.script-contas')
