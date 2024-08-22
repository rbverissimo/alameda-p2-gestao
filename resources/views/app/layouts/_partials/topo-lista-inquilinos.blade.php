<div class="row">
    <div class="col-3">
        <input  placeholder="Digite um nome para buscar:" name="nome" id="search-inquilino-nome">
    </div>
    <div class="col-4">
        <select name="situacao" id="ativos-inativos-select">
            <option value="" selected disabled>Pesquise pela situação:</option>
            <option value="A">Ativos</option>
            <option value="I">Inativos</option>
            <option value="T">Ambos</option>
        </select>
    </div>
    <div class="col-4">
        <x-forms.select
            label-text=""
            pattern-name="imovel"
            :collection="$imoveis"
        />
    </div>
</div>