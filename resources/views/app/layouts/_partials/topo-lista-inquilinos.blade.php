<div class="dashboard light-dashboard">
    <div class="row">
        <div class="col-2">
            <button onclick="navigateToLastRoute()" class="button common-button">Voltar</button>
        </div>
        <div class="col-2">
            <button onclick="redirecionarPara('{{ route('cadastrar-inquilino')}}')" class="button action-button" >
                Cadastrar
            </button>
        </div>
        <div class="col-2">
            <input  placeholder="ID:  " id="search-keyup-id" onkeydown="apenasNumeros(event)" onkeyup="getSearchById()">
        </div>
        <div class="col-3">
            <input placeholder="Nome: " id="search-keyup-nome">
        </div>
        <div class="col-3">
            <select name="" id="">
                <option value="">Ativos</option>
                <option value="">Inativos</option>
            </select>
        </div>
    </div>
</div>