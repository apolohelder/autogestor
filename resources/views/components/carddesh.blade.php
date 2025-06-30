@props(['route', 'color', 'icon', 'text', 'count'])

<div class="col-md mb-3">
    <a href="{{ route($route) }}" class="rounded-2 d-flex p-3 w-100 text-decoration-none text-secondary-emphasis shadow">
        <div
            class="text-center rounded-2 bg-{{ $color }} col-icon d-flex justify-content-center align-items-center text-white ">
            <i class="fa fa-{{ $icon }} fa-2x mb-2" aria-hidden="true"></i>
        </div>
        <div class="ms-3">
            <p class="m-0"><small>{{ $text }}</small></p>
            <p class="m-0 text-primary-emphasis fs-4">{{ $count }}</p>
        </div>
    </a>
</div>
