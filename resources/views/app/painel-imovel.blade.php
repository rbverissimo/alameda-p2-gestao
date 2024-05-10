@extends('app.layouts.template-basico')

@section('conteudo')

<div class="row">
    <div class="dashboard-card">
            <div class=" col-8">
                <span>
                    Gastos (soma das contas de água, energia, etc): R$ 1500
                </span><br>
                <span>
                    Receitas esperadas: R$ 4500
                </span><br>
                <span>
                    Receitas já recebidas: R$ 3400
                </span><br>
                <span>
                    Saldo em caixa: R$115
                </span><br>

            </div>
            <div class="col-2">
                <button id="calcular-contas-botao-painel-imovel" class="button common-button">Calcular contas</button>
            </div>
    </div>
</div>
<div class="row">
    @include('app.layouts._components.lista_contas')
</div>

@endsection

@section('scripts')
    @include('app.scripts.script-lista-contas')
    @include('app.scripts.script-painel-imovel')
@endsection
