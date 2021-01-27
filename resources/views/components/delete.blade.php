<form action="{{ $url }}" class="d-inline-block" method="post" onsubmit="return confirm('Apakah Anda yakin akan melakukan aksi ini?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus data"><i class="cil-trash"></i></button>
</form>
