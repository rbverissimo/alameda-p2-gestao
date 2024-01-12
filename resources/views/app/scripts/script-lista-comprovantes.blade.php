@section('scripts')
<script type="text/javascript">
      /*
      VARIAVEIS GLOBAIS DE CONTROLE DE FLUXO
      */
      var isListaComprovantesVisivel = undefined;
      var isListaJaCarregada = false;

      var isSituacaoFinanceiraVisivel = undefined;
      var isSituacaoFinanceiraJaCarregada = false; 

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
                              const data = request.response;
                              const jsonArray = data['data'];
                              console.log(data);
                              criarRowsJson(jsonArray);
                              setTimeout(addClickEditarExcluir, 500);
                              setTimeout(AddClickHandlerNextPage(data), 500);
                              isListaJaCarregada = true;
                              
                        } else {
                              console.log(`Erro: ${request.status}`);
                        }
                  }
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
                  '<td>' + 'EDITAR' + '</td>' +
                  '<td>' + 'EXCLUIR' + '</td>';
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
            // next
            const lastIndex = data['links'].length - 1;

            const next = document.getElementById('next-page');
            next.addEventListener("click", function(){
                  requestAvancarPagina(data['links'][lastIndex]['url']);
                  console.log(data['links'][lastIndex]['url']);
            }); 

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

      function requestAvancarPagina(url){

            const request = new XMLHttpRequest();
                  request.open("GET", url);
                  request.send();
                  request.responseType = "json";
                  request.onload = () => {
                        if(request.readyState == 4 && request.status == 200){
                              const data = request.response;
                              jsonArray = data['data'];
                              limparTabela();
                              criarRowsJson(jsonArray);
                              setTimeout(addClickEditarExcluir, 500);
                              setTimeout(AddClickHandlerNextPage(data), 500);
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

</script>
@endsection