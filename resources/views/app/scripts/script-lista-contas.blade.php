@section('scripts')
<script>

const idImovel = {{ $id->id }};
console.log(idImovel);

document.addEventListener('DOMContentLoaded', function(){
    topoTable.style.display = "flex";
});

const topoTable = document.getElementById('topo-table-state');
console.log(topoTable);

</script>
@endsection