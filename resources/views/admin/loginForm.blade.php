<!doctype html>
<html lang="ot-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin</title>
</head>
<body>
<h1>Login Admin</h1>

<form action="{{ route('admin.login.do') }}" method="post">
    @csrf

    @if($errors->all())
        @foreach($errors->all() as $erro)
            <p><strong>{{ $erro }}</strong></p>
        @endforeach
    @endif

    <div>
        <label for="email">E-mail</label>
        <input type="text" name="email" id="email" value="{{ old('email')  }}">
    </div>

    <div>
        <label for="password">Senha</label>
        <input type="password" name="password" id="password">
    </div>

    <div>
        <button type="submit">Efetuar login</button>
    </div>

</form>


</body>
</html>
