<script type="module">

      import { isNotNullOrUndefined } from "{{ asset('js/scripts.js')}}";
      import { isBlank } from "{{ asset('js/scripts.js')}}";

      const idInquilino = @json($inquilino['id']);

      const botaoMaisInfo = document.getElementById('mais-info-painel-inquilino');

      const wrapperModal = document.getElementById('dashboard-modal-wrapper');
      const overlay = document.getElementsByClassName('overlay')[0];
      // Essa é a div do spinner
      const loadingOverlay = document.getElementById('loading-overlay');

      botaoMaisInfo.addEventListener('click', function(){
            window.location.href = '{{ route("detalhar-inquilino", ["id" => $inquilino["id"]]) }}';
      });

      /*
      * Esse é  método que vai abrir o modal disponibilizando as opções ao usuário
      */
      function toggleModal(){
        overlay.style.display = overlay.style.display === 'none' ? 'block' : 'none';
        wrapperModal.style.display = wrapperModal.style.display === 'none' ? 'block' : 'none';
      }
      
      
      function confirmarConsolidarSaldo(){
            console.log('Consolidar saldo clicado');
            toggleModal();
      }
      
      //Ao clicar no botão Cancelar do modal, ele faz o toggle do mesmo
      document.getElementById('botao-cancelar-modal').addEventListener('click', function(){
            toggleModal();  
      });
      
      document.getElementById('consolidar-saldo-button-painel-inquilino').addEventListener('click', confirmarConsolidarSaldo);
      

</script>