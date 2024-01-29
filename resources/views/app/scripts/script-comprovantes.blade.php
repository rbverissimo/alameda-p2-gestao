@section('scripts')
<script type="text/javascript">

const mensagem = {{ !! json_encode($mensagem)}}
console.log(mensagem);

if(mensagem === 1) showMensagem("Update feito com sucesso", "sucesso");

</script>
@endsection