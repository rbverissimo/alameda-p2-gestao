<div class="dashboard-card">
      <div class="col-12" >
            <div id="display-id-inquilino-hidden" style="display: none">{{$inquilino->id}}</div>
            <div class="divisor-header primary-divisor">
                  Dados do inquilino:
            </div>
            <div class="row">
                  <div class="col-4">
                        <span>Nome: {{$inquilino->nome}}</span>
                  </div>
                  <div class="col-3">
                        <span>Valor Aluguel: R${{$inquilino->valorAluguel}}</span>
                  </div>
                  <div class="col-3">
                        <span>Contato: </span><span id="span-telefone-celular-inquilino">{{$inquilino->telefone_celular}}</span>
                  </div>       
                  <div class="col-2">
                        <button id="mais-info-painel-inquilino"
                              class="inline-button light-button">Mais informações</button>
                  </div>
            </div>
      </div>
</div>
