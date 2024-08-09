<table>
    <tr>
          <th>Valor</th>
          <th>Serviço</th>
          <th>Ações</th>
    </tr>
    @foreach ($notas as $nota)
          <tr class="table-row">
                <td>
                    <a class="table-link">{{$nota->getValorBruto()}}</a>
                </td>
                <td>
                    @if (!empty($nota->getTipoServico()))   
                        @php
                            $values = array_values($nota->getTipoServico());
                            $tipo_descricao = $values[0];
                        @endphp 
                        <span>
                            {{ $tipo_descricao }}
                        </span>
                    @endif
                </td>
                <td>
                    <img class="crud-icon"   
                        src="{{asset('icons/edit-icon.svg')}}" 
                        alt="edit">
                    <img class="crud-icon" src="{{asset('icons/delete-icon.svg')}}" alt="delete">
                </td>
          </tr>
    @endforeach
</table>