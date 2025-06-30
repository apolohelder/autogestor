@props([
    'typeinput' => 'text',
    'text' => '',
    'infor' => '',
    'placeholder' => '',
    'value' => '',
    'class' => '',
    'required' => false,
])

<div class="form-floating mb-3">
    <input @if ($required) required @endif type="{{ $typeinput }}"
        class="form-control border-top-0 border-start-0 border-end-0 border-2 rounded-0 {{ $class }}"
        id="{{ $infor }}" name="{{ $infor }}" value="{{ $value }}" placeholder="{{ $placeholder }}">
    <label for="{{ $infor }}">{{ $text }}:</label>
</div>
