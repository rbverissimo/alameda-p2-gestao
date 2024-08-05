<table>
    <tr>
          <th>Nome</th>
          <th>Serviços</th>
          <th>Ações</th>
    </tr>
    @foreach ($prestadores as $prestador)
          <tr class="table-row">
                <td>
                    <a class="table-link">{{$prestador->nome}}</a>
                </td>
                <td>
                    @if (!empty($prestador->tipos))    
                        <span>
                            @php
                                $servicos_all = implode(', ', array_column($prestador->tipos, 'tipo'));
                                $servicos_dois_primeiros = array_slice($servicos_all, 0, 2);
                            @endphp
                            {{ $servicos }}
                        </span>
                    @endif
                </td>
                <td>
                    <img class="crud-icon" 
                        onclick="redirecionarPara('{{route('editar-prestador', $prestador->id)}}')"    
                        src="{{asset('icons/edit-icon.svg')}}" 
                        alt="edit">
                    <img class="crud-icon" src="{{asset('icons/delete-icon.svg')}}" alt="delete">
                </td>
          </tr>
    @endforeach
</table>