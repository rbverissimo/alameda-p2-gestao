<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">
        Informações básica da NFS-e
    </div>
    <div class="row">
        <div class="col-4">
            @php
                $dataEmissao = isset($nota) ? $nota->getDataEmissao() : null;
            @endphp
            <x-forms.input
                label-text="Data da emissão: "
                attr-name="data-emissao"
                pattern-name="data-emissao"
                :data-input="$dataEmissao"
            ></x-forms.input>
        </div>
        <div class="col-4">
            @php
                $valorBruto = isset($nota) ? $nota->getValorBruto() : null;
            @endphp
            <x-forms.input
                label-text="Valor bruto: "
                attr-name="valor-bruto"
                pattern-name="valor-bruto"
                :data-input="$valorBruto"
            ></x-forms.input>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            @php
                $serieNota = isset($nota) ? $nota->getSerie() : null;
            @endphp
            <x-forms.input
                label-text="Série: "
                attr-name="nota-serie"
                pattern-name="nota-serie"
                :data-input="$serieNota"
            ></x-forms.input>
        </div>
        <div class="col-5">
            @php
                $numeroDocumento = isset($nota) ? $nota->getNumeroDocumento() : null;
            @endphp
            <x-forms.input
                label-text="Nº do documento: "
                attr-name="numero-documento"
                pattern-name="numero-documento"
                :data-input="$numeroDocumento"
            ></x-forms.input>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            @php
                $servico = isset($nota) ? $nota->getTipoServico() : null;
                $tipos_servicos = [];
            @endphp
            <x-forms.select
                label-text="Selecione o tipo do serviço prestado: "
                pattern-name="tipos-servicos-select"
                :collection="$tipos_servicos"
                :selected-value="$servico"
            ></x-forms.select>
        </div>
    </div>
    <div class="row">
        <div class="dashboard light-dashboard">
            <div class="divisor-header secondary-divisor">Informações à cerca das retenções</div>
            <div class="row">
                <div class="col-2">
                    @php
                        $aliquota = isset($nota) ? $nota->getAliquota() : null;
                    @endphp
                    <x-forms.input
                        label-text="Alíquota: "
                        attr-name="aliquota"
                        pattern-name="aliquota"
                        :data-input="$aliquota"
                    ></x-forms.input>
                </div>
                <div class="col-4">
                    @php
                        $valorISS = isset($nota) ? $nota->getValorISS() : null;
                    @endphp
                    <x-forms.input
                        label-text="Valor ISS: "
                        attr-name="valor-iss"
                        pattern-name="valor-iss"
                        :data-input="$valorISS"
                    ></x-forms.input>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                @php
                    $baseINSS = isset($nota) ? $nota->getBaseINSS() : null;
                @endphp
                <x-forms.input
                    label-text="Base INSS: "                
                    attr-name="base-inss"
                    pattern-name="base-inss"
                    :data-input="$baseINSS"
                ></x-forms.input>
            </div>
            <div class="col-4">
                @php
                    $valorRetido = isset($nota) ? $nota->getValorRetido() : null;
                @endphp
                <x-forms.input
                    label-text="Valor retido: "                
                    attr-name="valor-retido"
                    pattern-name="valor-retido"
                    :data-input="$valorRetido"
                ></x-forms.input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="dashboard light-dashboard">
            <div class="divisor-header primary-divisor">Arquivo da NFS</div>
        </div>
        <div class="row">
            @php
                $arquivo_nota_servico = isset($nota) ? $nota->getArquivoNotaServico() : null;
            @endphp
            <x-forms.file-input
                label-text="Envie o arquivo da nota: "
                attr-name="arquivo-nota-servico"
                download-route="{{route('baixarNotaServico', ['idNotaServico' => $arquivo_nota_servico ])}}"
                :file="$arquivo_nota_servico"
            ></x-forms.file-input>
        </div>
    </div>
</div>