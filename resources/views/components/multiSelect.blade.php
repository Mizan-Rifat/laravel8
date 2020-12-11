
<div class="form-group">
    <label>{{ $label }}</label>
    <select 
        class="form-control select2" 
        multiple="multiple" 
        data-placeholder="Select a {{$name}}"
        name="{{ $name }}[]"
        style="width: 100%;"
    >
        @foreach($options as $option)
            <option 
                value="{{$option->id}}"
                @if( in_array($option->id,$value) )
                selected='selected'
                @endif
            >
                {{$option->name}}
            </option>
        @endforeach

    </select>
</div>



<script>
    document.addEventListener("DOMContentLoaded", function() {
       
        $('.select2').select2();
    });
</script>