<div class="dashboard-card col-12" >
      <div id="display-id-inquilino-hidden" style="display: none">{{$inquilino->id}}</div>
      <div class="row">
            <div class="col-4">
                  <span>Nome: {{$inquilino->nome}}</span>
            </div>
            <div class="col-3">
                  <span>Valor Aluguel: {{$inquilino->valorAluguel}}</span>
            </div>
            <div class="col-3">
                  <span>Contato: {{$inquilino->telefone_celular}}</span>
            </div>       
            <div class="col-2">
                  <button id="mais-info-painel-inquilino"
                        class="inline-button light-button">Mais informações</button>
            </div>
      </div>
</div>
