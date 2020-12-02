<div class="form-group">
    <label>{{$label}}</label>
    <textarea 
        id="textarea" 
        placeholder="Place some text here"
        name="{{$name}}"
        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">

        {{ old($name,$value)}}

    </textarea>

    @if ($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('#textarea').summernote({
            height: 200
        });
    });
</script>