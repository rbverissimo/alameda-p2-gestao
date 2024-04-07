@extends('app.layouts.template-basico')

@section('conteudo')
      <div class="row">
            <div class="col-3">Olá, usuário</div>
      </div>
      <div class="card">
            <div class="card-conteudo">
                  <a href="{{ route('calculo-contas')}}">Cálculo de contas</a>
            </div>
      </div>
      <div class="card">
            <div class="card-conteudo">
                  <a href="{{ route('listar-inquilinos')}}">Painel de inquilinos</a>
            </div>
      </div>
      <div class="card">
            <div class="card-conteudo">
                  <a href="{{ route('comprovantes-transferencia')}}">Comprovantes de transferência</a>
            </div>
      </div>
      <div class="card">
            <div class="card-conteudo">
                  <a>Contratos</a>
            </div>
      </div>
      <div class="card">
            <div class="card-conteudo">
                  <a>Serviços tomados</a>
            </div>
      </div>
      <div class="card">
            <div class="card-conteudo">
                  <a>Compras</a>
            </div>
      </div>
      <div class="card">
            <div class="card-conteudo">
                  <a>Imóvel</a>
            </div>
      </div>

@endsection