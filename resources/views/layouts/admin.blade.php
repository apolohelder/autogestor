<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ID Plus</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
</head>

<body class="bg-body-light">

    <x-notification />

    <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>

    {{--  wrapper  --}}
    <div class="min-vh-100 vh-100 position-relative top-0">

        {{--  Header Mobile  --}}
        <div class="d-flex d-lg-none py-3 ps-4 pe-3 border-bottom bg-dark justify-content-between">

            <x-menumobile />

            <div class="d-flex align-items-center justify-content-between">
                <a class="logo" href="/dashboard">
                    <img class="img-fluid" width="135" height="20" src="{{ asset('images/logo.svg') }}"
                        alt="Logo">
                </a>
            </div>

            <x-profile />

        </div>

        {{--  sidebar  --}}
        <aside style="background-color: #111110; border-right: 1px solid #65655b"
            class="d-none d-lg-block sidebar position-fixed top-0 start-0 bottom-0 d-block z-3 text-white font-weight-bold px-4 py-4">

            <div class="float-left w-full d-flex align-items-center justify-content-between mb-5">

                <a class="logo" href="/dashboard">
                    <img class="img-fluid" width="135" height="20" src="{{ asset('images/logo.svg') }}"
                        alt="Logo">
                </a>

                <button class="border-0 bg-transparent p-0" style="color: #ffffff80" id="btn-toggle">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </button>

            </div>

            <hr class="mb-4" style="border-color: #7c7b74">

            {{--  menu  --}}

            {{-- menu sidebar  --}}
            <x-menusidebar />

        </aside>

        {{--  painel  --}}
        <main class="painel">

            <div class="ms-auto main-panel position-relative vh-100 min-vh-100">

                <x-topbar />

                <div class="px-4 py-4">
                    @yield('content')
                </div>

            </div>

        </main>


    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>

</body>

</html>
