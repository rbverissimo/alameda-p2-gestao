@section('scripts')
<script>

const idImovel = {{ $id }};
var next_page_url = '';
var last_page_url = '';

document.addEventListener('DOMContentLoaded', function(){
    topoTable.style.display = "flex";
    carregarContas();
});

const topoTable = document.getElementById('topo-table-state');

function carregarContas() {

    const request = new XMLHttpRequest();
    request.open("GET", "/imoveis/listar-contas/" + idImovel);
    request.send();
    request.responseType = "json";
    request.onload = () => {
        if(request.readyState == 4 && request.status == 200){
            processarRequestTableRows(request);
        } else {
            console.error(`Erro ${request.status}`);
            console.log(request);
        }
    }
}

function processarRequestTableRows(request){
        const data = request.response;
        const jsonArray = data['data'];
        next_page_url = data['next_page_url'];
        last_page_url = data['links'][0]['url'];
        criarRowsJson(jsonArray);

        setTimeout(addClickEditarExcluir, 300);
        setTimeout(AddClickHandlerNextPage(data), 300);
        if(data.current_page > 1){
                setTimeout(AddClickHandlerPreviousPage(data), 300);
        }

      }

function criarRowsJson(jsonArray){
        const table = document.getElementById('lista-contas');
            
        jsonArray.forEach(function(object){
            let tr = document.createElement('tr');
            tr.classList.add('table-row');

            let referencia = object.ano + object.mes;
       
            tr.innerHTML = '<td>' + object.id + '</td>' +
            '<td>' + converterTipoConta(object.tipocodigo)  + '</td>' +
            '<td>' + object.valor + '</td>' +
            '<td>' + converterReferencia(referencia) + '</td>' +
            '<td>' + '<img class="crud-icon" src="{{asset("icons/edit-icon.svg")}}" alt="EDITAR">' + '<img class="crud-icon" src="{{asset("icons/delete-icon.svg")}}" alt="EXCLUIR">'  + '</td>';
                table.appendChild(tr);
        });
            
}

function addClickEditarExcluir(){
    const table = document.getElementById('lista-contas');
    const rows = table.getElementsByTagName('tr');
    if((rows !== null || rows !== undefined) && rows.length > 0){
        for(i = 1; i < rows.length; i++){
            let currentRow = rows[i];

            lastColumn = currentRow.lastChild;
            var deletarIcon = lastColumn.lastChild;
            var editarIcon = deletarIcon.previousElementSibling;

            const id = currentRow.getElementsByTagName('td')[0].innerHTML;
            deletarIcon.addEventListener("click", function(){
                requestDeletarRow(id);
            });
                        
            editarIcon.addEventListener("click", function(){
                    requestEditarComprovante(id)
            });
        }
    }            
}

function AddClickHandlerNextPage(data) {
    const next = document.getElementById('next-page');
    next.addEventListener("click", clickNext, true); 
}

function clickNext(){
    requestTrocarPagina(next_page_url);
    document.getElementById('next-page').removeEventListener("click", clickNext, true);    
};

function AddClickHandlerPreviousPage(data) {
    const previous = document.getElementById('previous-page');
    previous.addEventListener("click", clickPrev, true);
}

function clickPrev(){
    requestTrocarPagina(last_page_url);
    document.getElementById('previous-page').removeEventListener("click", clickPrev, true);
}


function requestDeletarRow(id) {
    const isConfirmado = window.confirm("Você deseja deletar o registro " + id + " ?");
    if(isConfirmado){
         const request = new XMLHttpRequest();
        request.open("GET", "/calculo-contas/delete/"+ id);
        request.send();
        request.responseType = "json";
        request.onload = () => {
            if(request.readyState == 4 && request.status == 200){
                const data = request.response;
                if(data > 0) showMensagem("Registro removido com sucesso", "sucesso");
                limparTabela();
                carregarContas();                        
            } else {
                console.log(`Erro: ${request.status}`);
                showMensagem("Não foi possível remover o registro " + id, "falha");
            }
        }
    } else {
        showMensagem("Excluir o registro de ID: "+id+" não realizado", "neutra");
    }
}

function limparTabela(){
    let counter = 0
    const table = document.getElementById('lista-contas');
    const rows = table.getElementsByTagName('tr');
    if((rows !== null || rows !== undefined) && rows.length > 0){
        while(rows.length > 1){
            let currentRow = rows[1];
            currentRow.remove();
            counter++;
        }
    }

}

function requestEditarComprovante(id){
    window.location.href = "/calculo-contas/edit/" + id;
}

function converterTipoConta(tipo){
    let resultado = '';
    switch(tipo){
        case '1':
            resultado = 'Água';
            break;
        case '2':
            resultado = 'Energia';
            break; 
        default:
            resultado = 'Não identificado';
    }

    return resultado; 
}

</script>
@endsection