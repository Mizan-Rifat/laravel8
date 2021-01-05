@php

$rr = $pivotData->where('id',2)->first()->pivot->value;
dump($rr);
@endphp
<div class="card" id='pivot' style="margin:25px">
            
    <div class="card-body p-0 ">
    <table class="table table-striped">
        
        <tbody id='nvtbody'>

            @foreach($pivotData as $data)
          
                <tr id="tr-{{ $data->id }}">
                    <td>{{ $data->title }}</td>
                    <td>
                        <input 
                                type="text" 
                                class="form-control"
                                placeholder='Value'
                                data-id="{{$data->id}}"
                                value="{{ $data->pivot->value }}"
                        >
                    </td>
                </tr>
            @endforeach

            <input 
                type="hidden"
                name="nutritionalValues" 
            >

        </tbody>
    </table>
    </div>
</div>

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {

        let vari = @json(strtolower(str_replace(' ', '',$label)));
        let id = '.select2-' + vari;

        let allOptions = @json($options).map(item=>item.id);

        

        // $(id).val(allOptions);
        // $(id).trigger('change');

        let selectedData = $(id).select2('data');

      
        let tr = (data,pivotData)=>`
            <tr id="tr-${data.id}">
                <td>${data.element.label}</td>
                <td>
                <input 
                        type="text"
                        value="$"
                        data-id="${data.id}"
                        class="form-control pivotData"
                        placeholder='Value'
                >
                </td>
            </tr>
        `;


        selectedData.map((item)=>{
            $('#nvtbody').append(tr(item,@json('pivotData')));
        })


        $(id).on('select2:select', function (e) {
            var data = e.params.data;
            $('#nvtbody').append(tr(data));
            // console.log(data);
        });
        $(id).on('select2:unselect', function (e) {
            var data = e.params.data;
            $(`#tr-${data.id}`).remove();
            // console.log(data);
        });
        setValue();


        function getValue(){
            let values = {};
            $("#nvtbody :input[type=text]").each(function(){
                let input = $(this);
                values[input.data('id')] = { value : input.val()} 
            });
            return values;
        }
        function setValue(){
            let value = getValue();
            console.log({value})
            $("#nvtbody :input[name=nutritionalValues]").val(JSON.stringify(value))
        }

        $(document).on("change", "#nvtbody input" , function() {
            setValue();
        });



    });

</script>
@stop