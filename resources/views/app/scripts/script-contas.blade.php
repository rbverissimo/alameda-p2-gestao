@section('scripts')
<script type="module">

      import { anoMesMascara } from "{{ asset('js/scripts.js')}}";
      import { handleBackspaceHyphen } from "{{ asset('js/scripts.js')}}";
      import { isDataValida } from "{{ asset('js/scripts.js')}}";
      import { dataMascara } from "{{ asset('js/scripts.js')}}";
      import { mascaraCurrencyBr } from "{{ asset('js/scripts.js')}}";
      import { apenasNumeros } from "{{ asset('js/scripts.js') }}";
      import { navigateBack } from "{{ asset('js/scripts.js') }}";

      const mensagem = @json($mensagem);
      if(mensagem === 'sucesso') showMensagem("Registro salvo com sucesso! ", "sucesso");


      navigateBack("{{route('painel-principal')}}");

      const anoMesInput = document.getElementById('ano-mes-input');
      anoMesInput.addEventListener('input', anoMesMascara);
      anoMesInput.addEventListener('keydown', handleBackspaceHyphen);

      const dataInput = document.getElementById('data-input');
      dataInput.addEventListener('input', dataMascara);
      dataInput.addEventListener('keydown', handleBackspaceHyphen);

      dataInput.addEventListener('blur', function(event) {
            if (!isDataValida(event.target.value)) {
                  // Resetar se o valor não for válido
                  event.target.value = '';
            }
      });

      const valorInput = document.getElementById('input-valor');
      valorInput.addEventListener('input', mascaraCurrencyBr);

      const elementosApenasNumeros = document.getElementsByClassName('numero-input');
      
      for(const e of elementosApenasNumeros){
            e.addEventListener("keydown", apenasNumeros);
      }

      const salaSelect = document.getElementById('sala-select');
      const tipoContaSelect = document.getElementById('tipo-conta-select');
      tipoContaSelect.addEventListener('change', function(){
            var selectedValue = this.value;
            if(selectedValue === '2'){
                  salaSelect.style.display = 'block';
            } else {
                  salaSelect.style.display = 'none';
            }
      });

</script>
@endsection