
@php
$fields = [];

foreach($allFields as $field){
    if($field['type'] == 'image'){
        $field['value'] = isset($data) && $data->image != null ? json_decode($data->image) : [];

    }
    elseif($field['type'] == 'relationship-select'){
        $field['type']='select';
        $field['options'] = ${$field['edit_field']};
        $field['value'] = isset($data) ? $data->{$field['field']}->id : [];
    }
    elseif($field['type'] == 'relationship-multi-select'){
        $field['type']='multi-select';
        $field['options'] = ${$field['edit_field']}->map(function($item) use($field){
            return [
                'id'=>$item->id,
                'name'=>$item->{$field['relationship_field']},
            ];
        });
        $field['value'] = isset($data) ? $data->{$field['field']}->pluck('id')->toArray() : [];
    }else{
        $field['value'] = isset($data) ? $data->{$field['edit_field']} : false;

    }
    
    array_push($fields,$field);

   

}

@endphp


<form 
        method="post" 
        action="{{ isset($data) ? route(get_route($dataType,'update')) : route(get_route($dataType,'store'))}}" 
        role="form"
        enctype="multipart/form-data"
        id='form'
    >
        
        @csrf
        <div class="card-body">

            @foreach($fields as $field)

            

                @php
                    $label = $field['label'];
                    $type = $field['type'];
                    $value = $field['value'];
                    $column = $field['column'];
                    $options = array_key_exists('options',$field) ? $field['options'] : null;
                @endphp

                @if($field['type'] == 'text')
                    <x-input 
                        :label='$label' 
                        :name='$column' 
                        :placeholder='$label' 
                        :value='$value'  
                    />

                @endif

                @if($field['type'] == 'select')
                    <x-select 
                        :label='$label'
                        :options='$options'
                        :name='$column'
                        :value='$value'  
                    />

                @endif

                @if($field['type'] == 'multi-select')
                    <x-multiSelect
                        :label='$label'
                        :options='$options'
                        :name='$column'
                        :value='$value'  
                    />

                @endif

                @if($field['type'] == 'text-area')
                    <x-editor
                        :label='$label'
                        :name='$column' 
                        :value='$value'  
                    />

                @endif

                @if($field['type'] == 'switch')
                    <x-switch
                        :label='$label'
                        :name='$column' 
                        :value='$value'  
                    />

                @endif

                @if($field['type'] == 'image')

                   

                    @if(isset($data))
                        @php
                            $arg = [$dataType=>$data->id];
                        @endphp
                        <x-gallery 
                            :images='$value'
                            :label='$label'
                            :removeRoute="get_route($dataType,'removeimage')"
                            :arg="$arg"
                        />
                    @endif
                    <x-imageUploader
                        label='Upload Image'
                        :images='$value' 
                    />

                @endif

            @endforeach

            @if(isset($data))
                <input type="hidden" name='id' value="{{$data->id}}">
            @endif

        </div>

        @if(Route::currentRouteName() == 'roles.create' || Route::currentRouteName() == 'roles.edit')
            <div class="card-body">
                <h3>Permissions</h3>
                @include('admin.partials.checkbox')
            </div>
        @endif

        

        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">

                {{ config("datatypes.".pluralDatatype($dataType))['nextBtn'] != null ? "Next" : 'Submit' }}

            </button>
        </div>

    </form>


@section('js')
<script>



</script>
 @parent
@stop
