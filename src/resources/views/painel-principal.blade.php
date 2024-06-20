@extends('app.layouts.template-basico')

@section('conteudo')
      <div class="row">
            <div class="col-3">
                  <span class="basic-card-wrapper">
                        Olá, {{ $nome_usuario }}
                  </span>
            </div>
            <div class="col-7">
            </div>
            <div class="col-2">
                  <button class="logout-button">
                        <a href="{{ route('logout')}}">Sair</a>
                  </button>
            </div>
      </div>
      <div onclick="redirecionarPara('{{ route('calculo-contas') }}')" class="card">
            <div class="card-conteudo">
                  <a href="{{ route('calculo-contas')}}">Contas dos Imóveis</a>
            </div>
      </div>
      <div onclick="redirecionarPara('{{ route('listar-inquilinos') }}')" class="card">
            <div class="card-conteudo">
                  <a href="{{ route('listar-inquilinos')}}">Painel de Inquilinos</a>
            </div>
      </div>
      <div onclick="redirecionarPara('{{ route('comprovantes-transferencia') }}')" class="card">
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
                  <a href="{{ route('compras') }}">Compras</a>
            </div>
      </div>
      <div onclick="redirecionarPara('{{ route('imoveis') }}')" class="card">
            <div class="card-conteudo">
                  <a href="{{ route('imoveis') }}">Imóveis</a>
            </div>
      </div>

@endsection