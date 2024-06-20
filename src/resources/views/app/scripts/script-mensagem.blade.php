<script type="module">

    import { showMensagem } from "{{ asset('js/scripts.js')}}";

    const mensagem = @json($mensagem);
    if(mensagem['status'] === 'sucesso') showMensagem(mensagem['mensagem'], "sucesso");

</script>