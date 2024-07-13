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
                <td><a class="table-link">{{ $conta->dataVencimento}}</a></td>
                <td><a class="table-link">{{ $conta->valorinquilino}}</a></td>
                <td><a class="table-link">{{ $conta->quitada}}</a></td>
                <td>
                    <div class="col-3">
                        <img class="crud-icon" src="{{asset("icons/edit-icon.svg")}}" alt="EDITAR">
                    </div>
                </td>
            </tr>
        @endforeach
    @endisset      
</table>
 