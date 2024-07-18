<table id='lista-contas-inquilino'>
    <tr>
        <th>Data Vencimento</th>
        <th>Valor</th>
        <th>Quitada?</th>
        <th>Ações</th>
    </tr>
    @isset($contas)
        @foreach ($contas as $conta)
            <tr class="table-row">
                <td><a class="table-link table-data-view">{{ $conta->dataVencimento}}</a></td>
                <td><a class="table-link table-valores-em-real">{{ $conta->valorinquilino}}</a></td>
                <td><a class="table-link table-quitacao-view">{{ $conta->quitada}}</a></td>
                <td>
                    <div class="col-3">
                        <img class="crud-icon" 
                        onclick="redirecionarPara( '{{ route('editar-conta-inquilino', $conta->id )}}' )"
                        src="{{asset("icons/edit-icon.svg")}}" alt="EDITAR">
                    </div>
                </td>
            </tr>
        @endforeach
    @endisset      
</table>
 