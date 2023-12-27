@extends('app.layouts.template-basico')

@section('conteudo')
      <div>
            <li><a href="{{ route('calculo-contas')}}">Fazer o cálculo de contas</a></li>
            <li><a href="{{ route('comprovantes-transferencia')}}">Declarar comprovantes de transferência</a></li>
      </div>
@endsection