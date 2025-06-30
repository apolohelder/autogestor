<form action="{{ $actionBtn }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm" onclick="return confirm('{{ $aletbtn }}');">
        <i class="fa fa-trash-o text-danger" aria-hidden="true"></i>
    </button>
</form>
