<!DOCTYPE html>
<html>
<head>
      <title>List of Pessoas</title>
</head>
<body>
      <h1>Pessoas</h1>

      <ul>
            @foreach ($pessoas as $pessoa)
                  <li>
                        <strong>Nome:</strong> {{ $pessoa->nome }}<br>
                        <hr>
                  </li>
            @endforeach
      </ul>
</body>
</html>
