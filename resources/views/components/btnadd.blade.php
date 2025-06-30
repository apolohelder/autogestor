@props(['btnHref', 'text', 'icon' => ''])

<a class="btn btn-success" href="{{ $btnHref }}">
    <i class="fa fa-{{ $icon }}" aria-hidden="true"></i>
    {{ $text }}
</a>
