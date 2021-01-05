
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
    }
    elseif($field['type'] == 'relationship-multi-select-pivot'){

        $field['options'] = ${$field['edit_field']}->map(function($item) use($field){
            return [
                'id'=>$item->id,
                'name'=>$item->{$field['relationship_field']},
            ];
        });
        $field['pivotPartials'] = $field['pivot_partials'];
        $field['pivotData'] = isset($data) ? $data->{$field['field']} : [];
        $field['value'] = isset($data) ? $data->{$field['field']}->pluck('id')->toArray() : [];
    }else{
        $field['value'] = isset($data) ? $data->{$field['edit_field']} : false;

    }
    
    array_push($fields,$field);

   

}

@endphp

@section('title', pluralTitle($dataType))

@section('plugins.Select2', true)
@section('plugins.SummerNote', true)

@section('content_header')
<h1>{{ pluralTitle($dataType) }}</h1>


<div class="mt-3 text-right">
    <a class="btn btn-warning m-1" href="{{ route( get_route($dataType,'index')) }}">
        <i class="fas fa-list">
        </i>
        Back To List
    </a>
</div>
@stop

@section('content')

@if ($errors->any())
 @foreach ($errors->all() as $error)
     <div>{{$error}}</div>
 @endforeach
@endif

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{isset($data) ? 'Edit' : 'Add' }} {{ singularTitle($dataType) }} </h3>
    </div>

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
                    $pivotPartials = array_key_exists('pivotPartials',$field) ? $field['pivot_partials'] : null;
                    $pivotData = array_key_exists('pivotData',$field) ? $field['pivotData'] : null;
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

                @if($field['type'] == 'relationship-multi-select-pivot')
            
                    <x-multiSelectPivot 
                        :label='$label'
                        :options='$options'
                        :name='$column'
                        :value='$value'  
                        :pivotData='$pivotData'  
                    />

                    @include('admin.partials.'.$pivotPartials)

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

        

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

</div>

@endsection


@section('js')
<script>



</script>
 @parent
@stop
