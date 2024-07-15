<table id='lista-contas-imovel'>
    <tr>
        <tr>
            <th>Conta</th>
            <th>Valor</th>
            <th>Mês/Ano</th>
            <th>Ações</th>
      </tr>
    </tr>
    @isset($contas_imovel)
        @foreach ($contas_imovel as $conta_imovel)
            <tr class="table-row">
                <td><a class="table-link">{{ $conta_imovel->getRelation('tipo_conta')->descricao}}</a></td>
                <td><a class="table-link">{{ $conta_imovel->valor}}</a></td>
                <td><a class="table-link">{{ $conta_imovel->mes.'/'.$conta_imovel->ano}}</a></td>
                <td>
                    <div class="col-3">
                        <img class="crud-icon" 
                        onclick="redirecionarPara( '{{ route('regravar-conta', $conta_imovel->id )}}' )"
                        src="{{asset("icons/edit-icon.svg")}}" alt="EDITAR">
                    </div>
                </td>
            </tr>
        @endforeach
    @endisset      
</table>
 