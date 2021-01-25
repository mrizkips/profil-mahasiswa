@if (session('alert'))
    @php $alert = session('alert') @endphp
    <div class="alert alert-{{ $alert['color'] }} alert-dismissible fade show" role="alert">
        {{ $alert['content'] }}
        <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="cil-x"></i></span></button>
    </div>
@endif
