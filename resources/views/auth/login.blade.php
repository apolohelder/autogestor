<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel | Login</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
</head>

<body>

    <x-notification />

    <main class="container-fluid">

        <div class="row min-vh-100">
            <div class="col-md-2 col-lg-6 d-none d-md-block bg-dark"></div>
            <div class="col-md-10 col-lg-6 bg-body-secondary">

                <div class="row d-flex align-items-center vh-100">

                    <div class="col-md-10 offset-md-1 col-lg-6 offset-lg-3">

                        <div class="text-center mb-4">
                            <h1>Bem-vindo!</h1>
                            <p>Faça login na sua conta</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}" autocomplete="off" class="needs-validation"
                            novalidate>

                            @csrf

                            <x-input required typeinput="text" text="Nome ou E-mail" infor="username"
                                placeholder="name@example.com" value="{{ old('username') }}" />

                            <x-input required typeinput="password" text="Senha" infor="password"
                                placeholder="Informe sua senha" />


                            <div class="d-flex justify-content-between mt-4">
                                <div class="form-check">
                                    <input class="form-check-input border border-secondary-subtle" type="checkbox"
                                        name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Manter-me conectado
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark btn-lg w-100 rounded-0 mt-5">Acessar minha
                                conta</button>


                        </form>

                    </div>


                </div>

            </div>

        </div>

    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
