<script type="module">

    import { isNotNullOrUndefined } from "{{ asset('js/validators/null-safe.js') }} ";
    import { showMensagem } from "{{ asset('js/scripts.js')}}";
    
    const mensagem = @json($mensagem);
    
    if(isNotNullOrUndefined(mensagem)){
        showMensagem(mensagem['mensagem'], mensagem['status']);
    }
    
</script>