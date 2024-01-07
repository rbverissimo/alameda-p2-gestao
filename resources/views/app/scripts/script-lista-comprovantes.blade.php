@section('scripts')
<script type="text/javascript">

      const inquilino = @json($inquilino);
      const id = inquilino['id'];
      

      function carregarComprovantes(){
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


                        
                  } else {
                        console.log(`Erro: ${request.status}`);
                  }
            }
      }

      function addClickHandlersParaCadaRow(){
            const table = document.getElementById('lista-comprovantes');
            const rows = table.getElementsByTagName('tr');

            if((rows !== null || rows !== undefined) && rows.length > 0){
                  for(i = 0; i < rows.length; i++){
                        let currentRow = table.rows[i];
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