<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AMBIENTE MASTER</title>
</head>
<body>
    <h1>Estamos na dashboard</h1>
    <a href="{{ route('master.logout') }}">Sair</a>
<pre>

    <h1>AMBBIENTE MASTER</h1>

    {{ auth()->user() }}

</pre>
</body>
</html>
