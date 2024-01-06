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
                        let data = request.response;
                        console.log(data);
                        // data = JSON.stringify(data)
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


                        
                  } else {
                        console.log(`Erro: ${request.status}`);
                  }
            }
      }
</script>
@endsection