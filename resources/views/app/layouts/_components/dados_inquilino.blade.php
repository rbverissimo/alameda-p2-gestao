<div>
      <h3>Dados do Inquilino: </h3>
      <br>
      <div><p>Nome: </p>{{$inquilino->nome}}</div>
      <div><p>Valor do Aluguel: </p>{{$inquilino->valorAluguel}}</div>
      <div><p>Contato: </p>{{$inquilino->telefone_celular}}</div>
      <div><p>Casa: </p>{{$inquilino->salaCodigo}} - {{$inquilino->$nomeSala}}</div>
      <div><p>Qtde pessoas no imóvel: </p>{{$inquilino->qtdePessoasFamilia}}</div>
</div>