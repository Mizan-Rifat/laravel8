<div class="form-group">
    <label>{{$label}}</label>
    <div 
        class="input-images" 
        @if ($errors->has('images'))
            style="border: 1px solid red;"
        @endif
    >
    </div>

    @if ($errors->has('images'))
        <span class="text-danger">{{ $errors->first('images') }}</span>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        $('.input-images').imageUploader();
    });
</script>