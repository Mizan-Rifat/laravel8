@php
$fields = [];

foreach($allFields as $field){
    if($field['type'] == 'images'){
        $field['value'] = json_decode($data->image);
    }
    elseif($field['type'] == 'image'){
        $field['value'] = $data->{$field['field']};
    }
    elseif($field['type'] == 'relationship-select'){
        $field['type']='select';
        $field['value'] = $data->{$field['field']}->{$field['relationship_field']};
    }
    elseif($field['type'] == 'relationship-multi-select'){
        $field['type']='multi-select';
        $field['value'] = $data->{$field['field']}->pluck($field['relationship_field'])->toArray();
    }else{
        $field['value'] =$data->{$field['field']};

    }
    
    array_push($fields,$field);

}


@endphp


@section('title', pluralTitle($dataType))

@section('content_header')
    <h1>{{pluralTitle($dataType)}}</h1>

    
    @php
        $arg = [];
        $arg[singularDatatype($dataType)] = $data->id;
     

    @endphp

    <x-showActions 
        :dataType='$dataType'
        :arg="$arg"

    />

@stop

@section('content')


    @foreach($fields as $field)
    
        <div class="card">
            <h5 class="card-header">{{$field['label']}}</h5>
            <div class="card-body">

                @if($field['type'] == 'images')
                    <img src="{{ isset($field['value']) ? asset($field['value'][0]) : null }}" alt="" style="max-width: 200px;">
                @elseif($field['type'] == 'image')
                    <img src="{{ isset($field['value']) ? asset($field['value']) : null }}" alt="" style="max-width: 200px;">
                @elseif($field['type'] == 'text-area')
                    <p>{!! $field['value'] !!}</p>
                @elseif($field['type'] == 'multi-select')
                    <ul style="padding-left: 20px;">
                        @foreach($field['value'] as $item)
                            <li>{{$item}}</li>
                        @endforeach
                    </ul> 
                @elseif($field['type'] == 'multi-select-pivot')
                    <ul style="padding-left: 20px;">
                        @foreach($field['value'] as $item)
                            <li>{{$item->title}} - {{$item->pivot->value}}</li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ $field['value'] }}</p>
                @endif

            </div>
        </div>

    @endforeach

    <div class='card'>
        @if(Route::currentRouteName() == 'roles.show')
            <div class="card-body">
                <h3>Permissions</h3>
                @include('admin.partials.checkbox')
            </div>
        @endif
    </div>

@endsection


@section('css')
@stop

    

@section('js')
<script>
  

</script>
@stop