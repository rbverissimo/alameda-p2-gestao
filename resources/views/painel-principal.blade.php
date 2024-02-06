@extends('app.layouts.template-basico')

@section('conteudo')
      <div>
            <li><a href="{{ route('calculo-contas')}}">Fazer o cálculo de contas</a></li>
            <li><a href="{{ route('comprovantes-transferencia')}}">Declarar comprovantes de transferência</a></li>
            <li><a href="{{ route('listar-inquilinos')}}">Ver inquilinos</a></li>
      </div>

      <div class="card">
            <div class="card-conteudo">
                  Cálculo de Contas
            </div>
      </div>
      <div class="card">
            <div class="card-conteudo">
                  Painel de Inquilinos
            </div>
      </div>
      <div class="card">
            <div class="card-conteudo">
                  Comprovantes de Transferência
            </div>
      </div>
@endsection