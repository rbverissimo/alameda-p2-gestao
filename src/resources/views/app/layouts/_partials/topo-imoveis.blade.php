<div class="dashboard light-dashboard">
      <div class="row">
            <div class="col-2">
                  <button onclick="navigateToLastRoute()" class="button common-button">
                        Voltar
                  </button>
            </div>
            @isset($imovel->id)    
                  <div class="col-2">
                        <button class="button action-button" >
                              Salas
                        </button>
                  </div>
            @endisset
      </div>
</div>