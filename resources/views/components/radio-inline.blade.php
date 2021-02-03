<div class="form-check @if(!$errors->has($name)) form-check-inline @endif">
    <input type="radio" name="{{$name}}" id="{{$id}}" class="form-check-input @error($name) is-invalid @enderror" value="{{$value}}" {{$selected}}>
    <label for="{{$id}}" class="form-check-label">{{$option}}</label>
    @if ($loop->last)
        @error($name)
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    @endif
</div>
