@extends('app.layouts.template-basico')

@section('conteudo')
<h4>Declare as contas e o mês de referência: </h4>
      <div>
            <div>
                  @component('app.layouts._components.form_contas')
                  @endcomponent
            </div>
      </div>
@endsection
