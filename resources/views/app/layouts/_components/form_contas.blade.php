<form action="{{route('calculo-contas')}}" method="POST">
      @csrf

      <div class="row">
            <div class="col-3">
                  
                  @isset($tipos_contas)
                        <select id="tipo-conta-select" name="tipo_conta">
                              @foreach ($tipos_contas as $conta)
                                                <option value="{{$conta->id}}">
                                                      {{$conta->descricao}}</option>
                              @endforeach   
                        </select>
                  @endisset
            </div>
            <div class="col-3">
                  @isset($tipos_salas)
                        <select id="sala-select" style="display: none" name="sala">
                              @foreach ($tipos_salas as $sala)
                                    <option value="{{$sala->id}}">
                                          {{$sala->nomesala}}
                                    </option>
                              @endforeach
                        </select>
                  @endisset
            </div>
            <div class="col-6">
                  <input id="input-valor"
                        required
                        name="valor-conta"
                        placeholder="Valor da conta em reais: ">
            </div>
      </div>
      <div class="row">
            <div class="col-6">
                  <input id="data-input"
                        name="data-vencimento"
                        required
                        placeholder="Data do Vencimento: ">
            </div>
            <div class="col-6">
                  <input id="ano-mes-input"
                        name="referencia"
                        required
                        minlength="7"
                        placeholder="Referência: ">
            </div>
      </div>
      <div class="row">
            <div class="col-6">
                  <input class="numero-input" 
                        name="numero-documento"
                        placeholder="Número do documento: ">
            </div>
            <div class="col-4">
                  <input class="numero-input"
                        name="ano"
                        required
                        minlength="2" 
                        maxlength="4" 
                        placeholder="Ano: ">
            </div>
            <div class="col-2">
                  <input class="numero-input"
                        name="mes"
                        required
                        minlength="1"
                        maxlength="2"
                        placeholder="Mês: ">
            </div>
      </div>
      <div class="row center-itens">
            <div class="col-3">
                  <button class="button confirmacao-button" type="submit">OK</button>
            </div>
      </div>
</form>