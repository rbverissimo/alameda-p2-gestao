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
                        data = JSON.stringify(data)

                        document.querySelector('#show').innerHTML = data;
                  } else {
                        console.log(`Erro: ${request.status}`);
                  }
            }
      }
</script>
@endsection