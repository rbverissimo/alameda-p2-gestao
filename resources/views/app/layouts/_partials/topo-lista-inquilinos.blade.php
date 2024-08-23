<div class="row">
    <div class="col-3">
        <input 
            class="search-inquilino"    
            placeholder="Digite um nome para buscar:" 
            name="nome" 
            id="search-inquilino-nome">
    </div>
    <div class="col-4">
        <select 
            class="search-inquilino"
            name="situacao" 
            id="ativos-inativos-select">
            <option value="" selected disabled>Pesquise pela situação:</option>
            <option value="A">Ativos</option>
            <option value="I">Inativos</option>
            <option value="T">Ambos</option>
        </select>
    </div>
    <div class="col-4">
        <x-forms.select
            classes="search-inquilino"
            pattern-name="imovel-search"
            :collection="$imoveis"
        />
    </div>
</div>