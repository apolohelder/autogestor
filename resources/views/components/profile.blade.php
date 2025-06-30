<div class="btn-group">

    {{--  btn Desktop  --}}
    <button type="button" class="btn border-0 align-items-center ps-lg-1 p-0 py-lg-0 gap-3 rounded-2 d-flex"
        data-bs-toggle="dropdown" aria-expanded="false">
        <img class="img-fluid rounded-circle border border-secondary" width="38" height="38"
            src="{{ Auth::user()->profile_photo_url }}" alt="Foto de perfil">

        <p class="m-0 d-none d-lg-block">Olá, <strong>{{ Auth::user()->name }}</strong></p>
    </button>

    <ul class="dropdown-menu">

        <li>
            <a class="dropdown-item" href="{{ route('users.edit', Auth::user()->id) }}">
                <i class="fa fa-user me-2" aria-hidden="true"></i>
                Perfil
            </a>
            <a class="dropdown-item" href=""
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out me-2" aria-hidden="true"></i>
                Sair
            </a>
        </li>

    </ul>

</div>
