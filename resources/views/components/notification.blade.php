<div class="position-absolute top-0 end-0">

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div style="max-width: 400px"
                class="alert alert-danger alert-dismissible fade show m-3 py-1 d-flex align-items-center gap-3 z-1 position-relative"
                role="alert">
                <i class="fa fa-2x fa-exclamation-triangle" aria-hidden="true"></i>
                <p class="m-0"><strong>Aviso</strong><br>{{ $error }}</p>
                <button type="button" class="bg-transparent border-0 position-absolute top-0 end-0 text-secondary"
                    data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
        @endforeach
    @endif

    @if (session('success') || session('error') || session('warning'))

        @if (session('success'))
            <div style="max-width: 400px"
                class="alert alert-success alert-dismissible fade show m-3 py-1 d-flex align-items-center gap-3 z-1 position-relative"
                role="alert">
                <i class="fa fa-2x fa-check-square" aria-hidden="true"></i>
                <p class="m-0"><strong>Aviso</strong><br>{{ session('success') }}</p>
                <button type="button" class="bg-transparent border-0 position-absolute top-0 end-0 text-secondary"
                    data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
        @endif

        @if (session('warning'))
            <div style="max-width: 400px"
                class="alert alert-warning alert-dismissible fade show m-3 py-1 d-flex align-items-center gap-3"
                role="alert">
                <i class="fa fa-2x fa-check-circle" aria-hidden="true"></i>
                <div>
                    <strong>Sucesso!</strong><br>
                    {{ session('warning') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div style="max-width: 400px"
                class="alert alert-danger alert-dismissible fade show m-3 py-1 d-flex align-items-center gap-3 z-1 position-relative"
                role="alert">
                <i class="fa fa-2x fa-exclamation-triangle" aria-hidden="true"></i>
                <p class="m-0"><strong>Aviso</strong><br>{{ session('error') }}</p>
                <button type="button" class="bg-transparent border-0 position-absolute top-0 end-0 text-secondary"
                    data-bs-dismiss="alert" aria-label="Close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
        @endif
    @endif
</div>
