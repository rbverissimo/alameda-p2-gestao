@section('scripts')

<script type="module">

import { swapPontosVirgulas } from "{{ asset('js/scripts.js') }}";

const valorAluguelElements = document.getElementsByClassName('valor-aluguel-lista-inquilinos');

document.addEventListener('DOMContentLoaded', function(){
        Array.from(valorAluguelElements).forEach(e => {
            e.textContent = swapPontosVirgulas(e.textContent);
        });
    });
</script>

@endsection