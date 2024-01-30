@section('scripts')
<script type="module">

    import { showMensagem } from "{{ asset('js/scripts.js')}}";

    
    const mensagem = @json($mensagem);
    console.log(mensagem);

    if(mensagem === 'sucesso') showMensagem("Registro salvo com sucesso", "sucesso");

</script>
@endsection