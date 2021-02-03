<input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
    class="form-control @error($name) is-invalid @enderror"
    placeholder="{{ $placeholder }}" value="{{ $value }}"
    @if($required) required @endif
    @if($autofocus) autofocus @endif
    @isset($disabled)
        @if($disabled) disabled @endif
    @endisset
    @isset($readonly)
        @if($readonly) readonly @endif
    @endisset
>
@error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
