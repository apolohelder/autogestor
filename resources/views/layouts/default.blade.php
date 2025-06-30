<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ID Plus</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
</head>

<body class="bg-dark vh-100">

    <x-notification />

    <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>

    <div class="p-4 d-flex justify-content-between">
        <div>
            <img class="img-fluid me-auto" width="135" height="20" src="{{ asset('images/logo.png') }}"
                alt="Logo">
        </div>
        @guest
            <a class="btn btn-warning ms-md-5" href="{{ route('login') }}">Entrar</a>
        @endguest

        @auth
            <div class="bg-white rounded-2 py-2 px-3 ms-auto d-inline-block">
                <x-profile />
            </div>
        @endauth

    </div>

    @yield('content')

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
