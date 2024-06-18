<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">
        Informações do imóvel cadastrado
    </div>
    <div class="row">
        <div class="col-6">
            <span class="basic-card-wrapper">
                {{ $imovel_cadastrado['nomefantasia'] }}
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <span class="basic-card-wrapper">
                {{ $imovel_cadastrado['endereco'] }}
            </span>
        </div>
    </div>
</div>
<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">
        Salas cadastradas
    </div>
    @foreach ($salas_cadastradas as $sala)
        <div class="row">
            <div class="col-6">
                <span class="basic-card-wrapper">
                    {{ $sala['descricao'] }}
                </span>
            </div>
            <div class="col-4">
                <span class="basic-card-wrapper">
                    {{ $sala['tipo'] }}
                </span>
            </div>
        </div>
    @endforeach
</div>