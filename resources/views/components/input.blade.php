
<div class="form-group">
    <label for="exampleInputEmail1">{{$label}}</label>
    <input 
        type="text" 
        name='{{$name}}' 
        class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
        placeholder={{$placeholder}} 
        value="{{ old($name,$value)}}"
    >
    @if ($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif
</div>