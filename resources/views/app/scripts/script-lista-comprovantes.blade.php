@section('scripts')
<script type="text/javascript">
      /*
      VARIAVEIS GLOBAIS DE CONTROLE DE FLUXO
      */
      var isListaComprovantesVisivel = undefined;
      var isListaJaCarregada = false;
      var isSituacaoFinanceiraVisivel = undefined;

      const inquilino = @json($inquilino);
      const id = inquilino['id'];
      

      function carregarComprovantes(){
            isSituacaoFinanceiraVisivel = false;
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
                                    '<td>' + object.tipocomprovante + '</td>';
                                    table.appendChild(tr);
                              });

                              addClickHandlersParaCadaRow();
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
</script>
@endsection