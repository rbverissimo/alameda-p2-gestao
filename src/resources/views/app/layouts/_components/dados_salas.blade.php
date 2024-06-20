<div class="dashboard light-dashboard">
    <div class="divisor-header secondary-divisor">
        Informações sobre a sala
    </div>
    <div class="row">
        <div class="col-9">
            <span class="basic-card-wrapper">
                Clique no botão "Nova sala" para cadastrar mais de uma sala no Imóvel {{ $imovel->nomefantasia }}
            </span>
        </div>
        <div class="col-3">
            <button type="button" class="button action-button" id="adicionar-sala-button">
                Nova sala
            </button>
        </div>
    </div>
    <div class="row"></div>
    <div id="wrapper-salas">
        <div class="row">
            <div class="col-7">
                <input type="text" name="input-sala-form-nome-1" placeholder="Digite aqui o nome da sala ">
            </div>
            <div class="col-3">
                <select name="input-sala-form-tipo-1" id="">
                    <option value="1">Residencial</option>
                    <option value="2">Comercial</option>
                    <option value="3">Uso misto</option>
                </select>
            </div>
            <div class="col-2">
                <img src="{{asset("icons/delete-icon.svg")}}" alt="EXCLUIR">
            </div>
        </div>
    </div>

</div>