@extends('app.layouts.template-basico')

@section('conteudo')

<div class="row">
    <div class="dashboard-card">
            <div class=" col-8">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                Est fugiat ad iusto eligendi quis vel quasi ullam maxime saepe asperiores magni, 
                architecto cum iure labore nostrum ipsum cupiditate corrupti dolore.
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                Quod ea laudantium iure explicabo voluptate rerum ipsam qui sapiente blanditiis libero.
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
