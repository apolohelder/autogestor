@props([
    'text' => 'text',
    'placeholder' => 'text',
    'infor' => 'text',
    'idcreate' => 'text',
    'dataurl' => 'text',
    'idfeedback' => 'text',
    'btntext' => 'text',
])

<div class="mb-3">
    <label for={{ $infor }}>{{ $text }}</label>
    <input type="text" id={{ $infor }} class="form-control" placeholder="{{ $placeholder }}">
    <button type="button" id={{ $idcreate }} class="btn btn-sm btn-primary mt-2" data-url="{{ $dataurl }}">
        {{ $btntext }}
    </button>
    <small id={{ $idfeedback }} class="form-text text-muted"></small>
</div>
