@extends('app.layouts.template-basico')

@section('conteudo')

<div>
      @component('app.layouts._components.dados_inquilino', compact('inquilino'))
      @endcomponent
</div>

@endsection