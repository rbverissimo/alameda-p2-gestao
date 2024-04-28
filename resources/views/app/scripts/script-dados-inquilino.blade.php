@section('scripts')

<script type="module">


      const idInquilino = @json($inquilino['id']);

    const botaoMaisInfo = document.getElementById('mais-info-painel-inquilino');
    botaoMaisInfo.addEventListener('click', function(){
            window.location.href = '{{ route("detalhar-inquilino", ["id" => $inquilino["id"]]) }}';
      });


</script>
    
@endsection