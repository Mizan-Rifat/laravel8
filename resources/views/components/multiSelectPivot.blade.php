
<div class="form-group">
    <label>{{ $label }}</label>
    <select 
        class="form-control select2-{{ strtolower(str_replace(' ', '',$label)) }}" 
        multiple="multiple" 
        data-placeholder="Select {{$label}}"
        style="width: 100%;"
    >
    <!-- <option value="all">all</option> -->
        @foreach($options as $option)
            <option 
                value="{{$option['id']}}"
                @if( $value != null && in_array($option['id'],$value) )
                selected='selected'
                @endif
            >
                {{$option['name']}}
            </option>
        @endforeach

    </select>


    @if ($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif
</div>



<script>
    document.addEventListener("DOMContentLoaded", function() {

        let vari = @json(strtolower(str_replace(' ', '',$label)));
        let id = '.select2-' + vari;
        let selector = $(id).select2();

        $('#ff').click((e)=>{
            e.preventDefault();
            selector.val(['1', '2']);
            selector.trigger('change'); 
        })

        

    //     $(id).on("select2:select", function (e) { 
    //        var data = e.params.data.text;
    //        if(data=='all'){
    //         $(`${id} > option`).prop("selected","selected");
    //         $(`${id} > option`).trigger("change");
    //        }
    //   });


    });
</script>