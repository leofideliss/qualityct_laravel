<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ url('assets/imgs/logoMarrom.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/bootstrap/css/style.css') }}">
    
    <title>Login</title>
</head>

<body class="login">
    <div class="container border border-secondary col-md-4 p-4 centralize">

        <div class="row">
            <h5 class="">Login</h5>
        </div>
        <form action="{{ route('login.do') }}" method="POST">
            @csrf

            @if ($errors->all())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger mt-1" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif


            <div class="form-group mt-3">
                <label for="login"> Seu usuário</label>
                <input type="text" name="login" class="form-control" id="login" placeholder="Ex: joão">

            </div>

            <div class="form-group mt-3">
                <label for="password">Sua senha</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Ex: 1234">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Entrar</button>

    </div>
    </form>
    </div>


</body>

</html>
