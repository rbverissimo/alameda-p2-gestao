<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">
        Informações básica da NFS-e
    </div>
    <div class="row">
        <div class="col-4">
            <x-forms.input
                label-text="Data da emissão da nota: "
                attr-name="data-emissao"
                pattern-name="data-emissao"
                :data-input="$nota->dataEmissao"
                ></x-forms.input>
        </div>
    </div>
</div>