@props(['href', 'icon', 'text'])

<a class=" text-white-50 text-decoration-none btn-sidebar rounded-3 px-3 py-2 @if (Request::route()->getName() == $href) active @endif"
    style="font-size:14px; height:42px" href="{{ route($href) }}">
    <i class="fa fa-{{ $icon }} me-2" aria-hidden="true"></i>
    <span>{{ $text }}</span>
</a>
