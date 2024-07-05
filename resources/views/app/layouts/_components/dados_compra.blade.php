<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">
        Informações sobre a compra
    </div>
    <div class="row">
        <div class="col-3">
            <label for="data-compra-input" id="label-input-data-compra">Data da Compra:</label>
            <input id="data-compra-input"
                        name="data-compra"
                        required
                        placeholder="Data da Compra: "
                        value="{{ isset($compra->dataCompra) ? 
                        old('data-compra', $compra->dataCompra) : old('data-compra')}}">
            <span id="span-errors-data-compra" class="errors-highlighted">{{ $errors->has('data-compra') ? $errors->first('data-compra') : ' '}}</span> 
        </div>
        @isset($imoveis)
                  <div class="col-5">
                    <label for="imoveis-compra-select">Selecione um imóvel: </label>
                        <select id="imoveis-compra-select" 
                        required
                        name="imovel">
                              @foreach ($imoveis as $imovel)
                                    <option value="{{$imovel->id}}"
                                          @isset($compra->imovel)
                                                @if($compra->imovel == $imovel->id)
                                                selected
                                                @endif
                                          @endisset
                                    >
                                          {{$imovel->nomefantasia}}
                                    </option>
                              @endforeach
                        </select>
                  </div>
        @endisset
        <div class="col-4">
            <label for="valor-compra-input">Valor: </label>
            <input id="valor-compra-input"
                        name="valor-compra"
                        required
                        placeholder="Valor: "
                        value="{{ isset($compra->valor) ? 
                        old('valor-compra', $compra->valor) : old('valor-compra')}}">
            <span class="errors-highlighted">{{ $errors->has('valor-compra') ? $errors->first('valor-compra') : ' '}}</span> 
        </div>
        @isset($tipos_compras)
                  <div class="col-3">
                        <select id="tipo-compra-select" name="tipo-compra">
                              @foreach ($tipos_compras as $tipo_compra)
                                    <option value="{{$tipo_compra->id}}"
                                          @isset($compra->tipoCompra)
                                                @if($compra->tipoCompra == $tipo_compra->id)
                                                selected
                                                @endif
                                          @endisset
                                    >
                                          {{$tipo_compra->descricao}}
                                    </option>
                              @endforeach
                        </select>
                  </div>
        @endisset
    </div>

    <div class="row">
        @isset($formas_pagamento)
                  <div class="col-5">
                        <label for="forma-pagament-compra-select">Escolha uma forma de pagamento: </label>
                        <select id="forma-pagamento-compra-select" name="forma-pagamento">
                              @foreach ($formas_pagamento as $forma_pagamento)
                                    <option value="{{$forma_pagamento->codigo}}"
                                          @isset($compra->forma_pagamento)
                                                @if($compra->forma_pagamento === $forma_pagamento->codigo)
                                                selected
                                                @endif
                                          @endisset
                                    >
                                          {{$forma_pagamento->descricao}}
                                    </option>
                              @endforeach
                        </select>
                  </div>
        @endisset
        <div class="col-2">
            <label for="qtde-parcelas-compra">Qtde Parcelas: </label>
            <input
                id="qtde-parcelas-compra"
                disabled
                maxlength="2"
                name="qtde-parcelas"
                value="{{ isset($compra->qtdeParcelas) ? 
                    old('qtde-parcelas', $compra->qtdeParcelas) : old('qtde-parcelas')}}">
            <span class="errors-highlighted">{{ $errors->has('qtde-parcelas') ? $errors->first('qtde-parcelas') : ' '}}</span> 
        </div>
        <div class="col-5">
            <label for="nome-vendedor-compra">Nome do vendedor: </label>
            <input
                id="nome-vendedor-compra"
                maxlength="60"
                name="nome-vendedor"
                value="{{ isset($compra->nome_vendedor) ? 
                    old('nome-vendedor', $compra->nome_vendedor) : old('nome-vendedor')}}">
            <span class="errors-highlighted">{{ $errors->has('nome-vendedor') ? $errors->first('nome-vendedor') : ' '}}</span> 
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <label for="qtde-dias-garantia-input">Qtde dias garantia:</label>
            <input id="qtde-dias-garantia-input"
                        name="qtde-dias-garantia"
                        placeholder="30"
                        maxlength="3"
                        value="{{ isset($compra->qtdeDiasGarantia) ? 
                        old('qtde-dias-garantia', $compra->qtdeDiasGarantia) : old('qtde-dias-garantia')}}">
            <span class="errors-highlighted">{{ $errors->has('qtde-dias-garantia') ? $errors->first('qtde-dias-garantia') : ' '}}</span> 
        </div>
        <div class="col-2">
            <span class="basic-card-wrapper">Garantia?</span>
        </div>
        <div class="col-2">
            <x-toggle-switch attName="garantia"></x-toggle-switch>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <label for="descricao-compra">Declare a motivação da compra:</label>
            <textarea name="descricao" id="descricao-compra" 
                rows="3" 
                required
                value="{{ isset($compra->descricao) ?
                    old('descricao', $compra->descricao) : old('descricao') }}"></textarea>
            <span class="errors-highlighted">{{ $errors->has('descricao') ? $errors->first('descricao') : ' '}}</span> 
        </div>
    </div>
</div>

<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">
       Informações da nota         
    </div>
    <div class="row">
        <div class="col-12">
            <label for="arquivo-nota"> 
                  Envie o comprovante:
            </label>
            <input type="file" id="arquivo-nota" name="arquivo-nota">
        </div>
    </div>
    <div class="row">
        @isset($compra->nota)
            <div class="col-12">
                <button class="button light-button">
                    <a id="link-arquivo-baixar">BAIXAR {{ $compra->nota }}</a>
                    <img style="margin-left: 1vw" src="{{asset('icons/download-icon.svg')}}" alt="download-icon">
                </button>
            </div>
        @endisset       
    </div>
    <div class="row">
        <div class="col-4">
            <label for="nr-documento-nota">Número do documento:</label>
            <input id="nr-documento-nota"
                        name="nr-documento"
                        value="{{ isset($compra->nrDocumento) ? 
                        old('nr-documento', $compra->nrDocumento) : old('nr-documento')}}">
            <span class="errors-highlighted">{{ $errors->has('nr-documento') ? $errors->first('nr-documento') : ' '}}</span> 
        </div>
    </div>
</div>