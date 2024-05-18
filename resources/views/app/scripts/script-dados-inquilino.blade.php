<script type="module">

      import { isNotNullOrUndefined } from "{{ asset('js/scripts.js')}}";
      import { isBlank } from "{{ asset('js/scripts.js')}}";

      const idInquilino = @json($inquilino['id']);

      const botaoMaisInfo = document.getElementById('mais-info-painel-inquilino');
      const divErros = document.getElementById('mensagem-erro-session');

      document.addEventListener('DOMContentLoaded', () => {
            displayMensagemErro();
      });
      
      botaoMaisInfo.addEventListener('click', function(){
            window.location.href = '{{ route("detalhar-inquilino", ["id" => $inquilino["id"]]) }}';
      });

      function displayMensagemErro(){
            if(!isBlank(divErros.textContent)){
                  showMensagem(divErros.textContent, 'falha', 5000);
            }
      }

</script>