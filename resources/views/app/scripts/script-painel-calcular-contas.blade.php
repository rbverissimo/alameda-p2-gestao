<script type="module">

    const wrapperModal = document.getElementById('dashboard-modal-wrapper');
    const overlay = document.getElementsByClassName('overlay')[0];

    document.getElementById('botao-realizar-calculos').addEventListener('click', function(){
        toggleModal();
    });


    document.getElementById('botao-cancelar-modal').addEventListener('click', function(){
        toggleModal();  
    });

    function toggleModal(){
        overlay.style.display = overlay.style.display === 'none' ? 'block' : 'none';
        wrapperModal.style.display = wrapperModal.style.display === 'none' ? 'block' : 'none';
    }

</script>