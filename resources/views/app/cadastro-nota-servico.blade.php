@extends('app.layouts.template-basico')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/checkboxes.css')}}">
@endpush

@section('conteudo')
<div class="dashboard light-dashboard">
    <div class="row">
        <div onclick="navigateToLastRoute()" class="col-2">
            <button class="button common-button">
                Voltar</button>
        </div>
        <div class="col-6">
            <button id="selecionar-servico-button" class="button action-button">Selecionar serviço prestado</button>
        </div>
    </div>
</div>
<div class="row">
    @include('app.layouts._components.form_nota_fiscal_servico', compact('nota', 'idPrestador'))
</div>
<div class="row">
    <div class="whitespace-end-page"></div>
</div>
@endsection

@section('scripts')
    <script type="module" src="{{asset('js/views/cadastro-nota-servico.js')}}"></script>
    @include('app.scripts.script-mensagem')
@endsection