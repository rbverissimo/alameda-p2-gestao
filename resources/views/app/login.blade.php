@extends('app.layouts.template-basico')


@section('conteudo')
    <div class="login-container col-8">
        <form action="" method="post">
            @csrf
            <div class="row center-itens">
                <div class="col-6">
                    <h2>Olá, seja bem-vindo(a)!</h2>
                </div>
            </div>
            <div class="row center-itens">
                <div class="col-6">
                    <span>Faça login para continuar</span>
                </div>
            </div>
            <div class="row center-itens">
                <div class="col-6">
                    <label for="username">Login</label>
                    <input type="text" name="username">
                </div>
            </div>
            <div class="row center-itens">
                <div class="col-6">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
            </div>
            <div class="row center-itens">
                <div class="col-4">
                    <button class="button confirmacao-button">Entrar</button>
                </div>
            </div>
        </form>
    </div>
@endsection