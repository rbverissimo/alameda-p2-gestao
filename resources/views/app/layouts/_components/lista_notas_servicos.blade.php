<table>
    <tr>
          <th>Valor</th>
          <th>Serviço</th>
          <th>Ações</th>
    </tr>
    @foreach ($prestadores as $prestador)
          <tr class="table-row">
                <td>
                    <a class="table-link">{{$prestador->getNome()}}</a>
                </td>
                <td>
                    @if (!empty($prestador->getTipos()))    
                        <span>
                            @php
                                $servicos = [];
                                foreach ($prestador->getTipos() as $tipo) {
                                    $servicos[] = $tipo['tipo'];
                                }
                                $primeiros_dois_servicos = array_slice($servicos, 0, 2);
                                $servicos_display = join(', ', $primeiros_dois_servicos);
                            @endphp
                            {{ $servicos_display }}
                        </span>
                    @endif
                </td>
                <td>
                    <img class="crud-icon"   
                        src="{{asset('icons/edit-icon.svg')}}" 
                        onclick="redirecionarPara('{{route('editar-prestador', $prestador->getId())}}')"
                        alt="edit">
                    <img class="crud-icon" src="{{asset('icons/delete-icon.svg')}}" alt="delete">
                </td>
          </tr>
    @endforeach
</table>