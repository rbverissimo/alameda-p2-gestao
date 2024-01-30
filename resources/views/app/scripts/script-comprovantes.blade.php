@section('scripts')
<script type="module">

    import { showMensagem } from "{{ asset('js/scripts.js')}}";

    
    const mensagem = {!! json_encode(session('mensagem')) !!};

if(mensagem === 'sucesso') showMensagem("Update feito com sucesso", "sucesso");

</script>
@endsection