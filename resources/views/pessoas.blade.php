<!DOCTYPE html>
<html>
<head>
      <title>List of Pessoas</title>
</head>
<body>
      <h1>List of Pessoas</h1>

      <ul>
            @foreach ($pessoas as $pessoa)
                  <li>
                        <strong>Nome:</strong> {{ $pessoa->nome }}<br>
                        <strong>CPF:</strong> {{ $pessoa->cpf }}<br>
                        <strong>Profissão:</strong> {{ $pessoa->profissao }}<br>
                        strong>Telefone:</strong> {{ $pessoa->telefone }}<br>
                        <hr>
                  </li>
            @endforeach
      </ul>
</body>
</html>
