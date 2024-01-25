@section('scripts')
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

      const inquilino = @json($inquilino);
      const id = inquilino['id'];
      
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
            console.log(data);
            criarRowsJson(jsonArray);

            setTimeout(addClickEditarExcluir, 500);
            setTimeout(AddClickHandlerNextPage(data), 500);
            if(data.current_page > 1){
                  setTimeout(AddClickHandlerPreviousPage(data), 500);
            }
      }

      function criarRowsJson(jsonArray){
            
            const table = document.getElementById('lista-comprovantes');
            
            jsonArray.forEach(function(object){
                  let tr = document.createElement('tr');
                  tr.innerHTML = '<td>' + object.id + '</td>' +
                  '<td>' + object.valor + '</td>' +
                  '<td>' + object.dataComprovante + '</td>' +
                  '<td>' + object.referencia + '</td>' +
                  '<td>' + object.tipocomprovante + '</td>' +
                  '<td>' + '<img class="crud-icon" src="{{asset("icons/edit-icon.svg")}}" alt="EDITAR">'  + '</td>' +
                  '<td>' + '<img class="crud-icon" src="{{asset("icons/delete-icon.svg")}}" alt="EXCLUIR">' + '</td>';
                  table.appendChild(tr);
            });
            
      }

      function addClickEditarExcluir(){
            const table = document.getElementById('lista-comprovantes');
            const rows = table.getElementsByTagName('tr');
            if((rows !== null || rows !== undefined) && rows.length > 0){
                  for(i = 1; i < rows.length; i++){
                        let currentRow = rows[i];
                        const secondToLastIndex = currentRow.getElementsByTagName('td').length - 2;
                        const id = currentRow.getElementsByTagName('td')[0].innerHTML;
                        currentRow.lastChild.addEventListener("click", function(){
                              requestDeletarRow(id);
                        });
                        
                        currentRow.getElementsByTagName('td')[secondToLastIndex].addEventListener("click", function(){
                              window.location='{{route("comprovante-editar", 'id')}}';
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
            document.getElementById('lista-comprovantes').style.visibility = "visible";
            document.getElementById('script-page').style.visibility = "visible"
            document.getElementById('situacao-financeira-wrapper').style.visibility = "hidden";
      }

      function requestDeletarRow(id) {
            const request = new XMLHttpRequest();
                  request.open("GET", "/comprovantes-transferencia/delete/"+ id);
                  request.send();
                  request.responseType = "json";
                  request.onload = () => {
                        if(request.readyState == 4 && request.status == 200){
                              const data = request.response;
                              limparTabela();
                              isListaJaCarregada = false;
                              carregarComprovantes();
                              
                        } else {
                              console.log(`Erro: ${request.status}`);
                        }
                  }

      }

      function requestTrocarPagina(url){
            console.log('request trocar pagina chamado'); 
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
            document.getElementById('situacao-financeira-wrapper').style.visibility = "visible";
            document.getElementById('lista-comprovantes').style.visibility = "hidden";
      }

      
      window.onload = function isReferenciaQuitada() {
                  const saldo = document.getElementById('saldo').innerHTML;
                  if(saldo > 0){
                        document.getElementById('quitado').checked = true; 
                  }
            }
      
      /* 
      * SCRIPTS DO TOPO
      */

      function addTableRow(){
            const url = new URL(window.location);
            const idInquilino = url.pathname.split('/')[2];
            window.location=`{{ route("comprovante-adicionar", ["id" => ""]) }}${'idInquilino'}`;

      }

</script>
@endsection