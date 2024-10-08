<script type="text/javascript">

      /*
      VARIAVEIS GLOBAIS DE CONTROLE DE FLUXO
      */
      var isListaComprovantesVisivel = undefined;
      var isListaJaCarregada = false;

      var isSituacaoFinanceiraVisivel = undefined;
      var isSituacaoFinanceiraJaCarregada = false; 

      var next_page_url = '';
      var last_page_url = '';
      var id;

      document.addEventListener('DOMContentLoaded', function(){
            id = document.getElementById('display-id-inquilino-hidden').innerHTML;
      });

      var timerPesquisa;

      /*
      * SCRIPTS LIGADOS AO CARREGAMENTO DA LISTA DE COMPROVANTES
      */
      function carregarComprovantes(){
            isSituacaoFinanceiraVisivel = false;
            showListaComprovantes();
            if(!isListaJaCarregada){
                  const request = new XMLHttpRequest();
                  request.open("GET", "/comprovantes-transferencia/"+ id);
                  request.send();
                  request.responseType = "json";
                  request.onload = () => {
                        if(request.readyState == 4 && request.status == 200){
                              processarRequestTableRows(request);
                              isListaJaCarregada = true;
                              
                        } else {
                              console.log(`Erro: ${request.status}`);
                        }
                  }
            }
      }

      function processarRequestTableRows(request){
            const data = request.response;
            const jsonArray = data['data'];
            next_page_url = data['next_page_url'];
            last_page_url = data['links'][0]['url'];
            criarRowsJson(jsonArray);

            setTimeout(addClickEditarExcluir, 300);
            setTimeout(AddClickHandlerNextPage(data), 300);
            if(data.current_page > 1){
                  setTimeout(AddClickHandlerPreviousPage(data), 300);
            }
      }

      function criarRowsJson(jsonArray){
            
            const table = document.getElementById('lista-comprovantes');
            
            jsonArray.forEach(function(object){
                  
                  let tr = document.createElement('tr');
                  tr.classList.add('table-row');
                  
                  tr.innerHTML = '<td>' + object.id + '</td>' +
                  '<td>' + 'R$' + swapPontosVirgulas(object.valor) + '</td>' +
                  '<td>' + showDataFormatadaDMY(object.dataComprovante) + '</td>' +
                  '<td>' + '<img class="crud-icon" src="{{asset("icons/edit-icon.svg")}}" alt="EDITAR">' 
                        + '<img class="crud-icon" src="{{asset("icons/delete-icon.svg")}}" alt="EXCLUIR">'  + '</td>';
                  table.appendChild(tr);
            });
            
      }

      function addClickEditarExcluir(){
            const table = document.getElementById('lista-comprovantes');
            const rows = table.getElementsByTagName('tr');
            if((rows !== null || rows !== undefined) && rows.length > 0){
                  for(i = 1; i < rows.length; i++){
                        let currentRow = rows[i];
                        lastColumn = currentRow.lastChild;
                        var deletarIcon = lastColumn.lastChild;
                        var editarIcon = deletarIcon.previousElementSibling;

                        const id = currentRow.getElementsByTagName('td')[0].innerHTML;
                        deletarIcon.addEventListener("click", function(){
                              requestDeletarRow(id);
                        });
                        
                        editarIcon.addEventListener("click", function(){
                              requestEditarComprovante(id)
                        });
                  }
            }            
      }

      function AddClickHandlerNextPage(data) {
            const next = document.getElementById('next-page');
            next.addEventListener("click", clickNext, true); 
      }

      function clickNext(){
                  requestTrocarPagina(next_page_url);
                  document.getElementById('next-page').removeEventListener("click", clickNext, true);    
            };

      function AddClickHandlerPreviousPage(data) {
            const previous = document.getElementById('previous-page');
            previous.addEventListener("click", clickPrev, true);
      }

      function clickPrev(){
                  requestTrocarPagina(last_page_url);
                  document.getElementById('previous-page').removeEventListener("click", clickPrev, true);
      }

      function showListaComprovantes(){
            document.getElementById('table-wrapper').style.display = "block";
            document.getElementById('lista-comprovantes').style.display = "block";
            document.getElementById('topo-table-state').style.display = "flex";
            document.getElementById('script-page').style.visibility = "visible";
            document.getElementById('situacao-financeira-wrapper').style.display = "none";
            document.getElementById('step-comprovantes').classList.add('active-tab');
            document.getElementById('step-situacao-financeira').classList.remove('active-tab');
      }

      function requestDeletarRow(id) {
            const isConfirmado = window.confirm("Você deseja deletar o registro " + id + " ?");

            if(isConfirmado){
                  const request = new XMLHttpRequest();
                  request.open("GET", "/comprovantes-transferencia/delete/"+ id);
                  request.send();
                  request.responseType = "json";
                  request.onload = () => {
                        if(request.readyState == 4 && request.status == 200){
                              const data = request.response;
                              if(data > 0) showMensagem("Registro removido com sucesso", "sucesso");
                              limparTabela();
                              isListaJaCarregada = false;
                              carregarComprovantes();
                                    
                              } else {
                                    console.log(`Erro: ${request.status}`);
                                    showMensagem("Não foi possível remover o registro " + id, "falha");
                              }
                        }

            } else {
                  showMensagem("Excluir o registro de ID: "+id+" não realizado", "neutra");
            }

      }

      function requestEditarComprovante(id){
            window.location.href = "/comprovantes-transferencia/edit/" + id;
      }

      function requestTrocarPagina(url){
            const request = new XMLHttpRequest();
                  request.open("GET", url);
                  request.send();
                  request.responseType = "json";
                  request.onload = () => {
                        if(request.readyState == 4 && request.status == 200){
                              limparTabela();
                              processarRequestTableRows(request);
                        } else {
                              console.log(`Erro: ${request.status}`);
                        }
                  }
      }

      function limparTabela(){
            let counter = 0
            const table = document.getElementById('lista-comprovantes');
            const rows = table.getElementsByTagName('tr');
            if((rows !== null || rows !== undefined) && rows.length > 0){
                  while(rows.length > 1){
                        let currentRow = rows[1];
                        currentRow.remove();
                        counter++;
                  }
            }

      }

      /*
      * SCRIPTS LIGADOS AO CARREGAMENTO DA SITUAÇÃO FINANCEIRA
      */
      function carregarSituacaoFinanceira(){
            showSituacaoFinanceira();

      }

      function showSituacaoFinanceira(){
            document.getElementById('situacao-financeira-wrapper').style.display = "block"
            document.getElementById('table-wrapper').style.display = "none";
            document.getElementById('step-comprovantes').classList.remove('active-tab');
            document.getElementById('step-situacao-financeira').classList.add('active-tab');
      }
      
      /* 
      * SCRIPTS DO TOPO DA TABELA;
      */

      function addTableRow(){
            const url = new URL(window.location);
            const id = url.pathname.split('/')[2]; 
            window.location.href = "/comprovantes-transferencia/add/" + id ;

      }

      function getSearchById(){
            const idComprovante =  document.getElementById('search-keyup-id').value;
            if(/^\d+$/.test(idComprovante) || idComprovante === ''){
                  getSearchBy('id', idComprovante);
            } else {
                  document.getElementById('search-keyup-id').value = value.replace(/\D/g, '');
            }
      }

      function getSearchByData(){
            const data =  document.getElementById('search-keyup-data').value;
            console.log(data);
      }

      function getSearchBy(paramName, paramValue) {
            clearTimeout(timerPesquisa);
            let route = `/comprovantes-transferencia/search/${paramName}/${paramValue}`;
            timerPesquisa = setTimeout(function(){
                  const request = new XMLHttpRequest();
                  if(!isBlank(paramValue)){
                        request.open("GET", route);
                        request.send();
                        request.responseType = "json";
                        request.onload = () => {
                              if(request.readyState == 4 && request.status == 200){
                                    limparTabela();
                                    processarRequestTableRows(request);
                                    isListaJaCarregada = true;
                                          
                              } else {
                                    console.log(`Erro: ${request.status}`);
                              }
                              }
                  } else {
                        isListaJaCarregada = false;
                        carregarComprovantes();
                        } 
            }, 300);
      }
      

</script>