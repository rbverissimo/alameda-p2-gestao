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
                              const table = document.getElementById('lista-comprovantes');
                              data.forEach(function(object){
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

                              setTimeout(addClickEditarExcluir, 500);
                              isListaJaCarregada = true;
                              
                        } else {
                              console.log(`Erro: ${request.status}`);
                        }
                  }
            }
      }

      function addClickHandlersParaCadaRow(){
            const table = document.getElementById('lista-comprovantes');
            const rows = table.getElementsByTagName('tr');

            if((rows !== null || rows !== undefined) && rows.length > 0){
                  for(i = 1; i < rows.length; i++){
                        let currentRow = rows[i];
                        currentRow.addEventListener("click", function (){
                              const id = currentRow.getElementsByTagName('td')[0].innerHTML;
                              console.log('clicked row id:' + id);
                              // implementar a navegação para outra view do blade com os dados para a edição do comprovante; 
                        });
                  }
            }
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
                              console.log('CLICKED ICON EXCLUIR id: ' + id);
                        });
                        
                        currentRow.getElementsByTagName('td')[secondToLastIndex].addEventListener("click", function(){
                              window.location='{{route("comprovante-editar", 'id')}}';
                              console.log('CLICKED ICON EDITAR id: ' + id);
                        });
                  }
            }            
      }

      function showListaComprovantes(){
            document.getElementById('lista-comprovantes').style.visibility = "visible";
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

      function limparTabela(){
            let counter = 0
            const table = document.getElementById('lista-comprovantes');
            const rows = table.getElementsByTagName('tr');
            if((rows !== null || rows !== undefined) && rows.length > 0){
                  while(rows.length > 1){
                        let currentRow = rows[1];
                        rows.remove();
                        counter++;
                  }
            }
            
            console.log('Linhas removidas da tabela:' + counter);

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