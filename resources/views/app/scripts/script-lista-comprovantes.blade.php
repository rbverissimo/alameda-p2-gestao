@section('scripts')
<script type="text/javascript">
      const request = new XMLHttpRequest();
      request.open("GET", "");
      request.send();
      request.responseType = "json";
      request.onload = () => {
            if(request.readyState == 4 && request.status == 200){
                  const data = request.response;
                  console.log(data);
            } else {
                  console.log(`Erro: ${request.status}`);
            }
      }
</script>
@endsection