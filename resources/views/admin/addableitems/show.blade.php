@extends('adminlte::page')

@php

    $allFields = config('datatypes.addable_items')['fields'];


    $fields = [];

    foreach($allFields as $field){
        if($field['type'] == 'image'){
            $field['value'] = isset($addableitem) ? json_decode($addableitem->image) : [];
        }else{
            $field['value'] = isset($addableitem) ? $addableitem->{$field['field']} : false;

        }
       
       array_push($fields,$field);
    }

@endphp

@section('title', 'AddableItems')

@section('content_header')
    <h1>AddableItems</h1>

    @php
        $arg = ['addableitem'=>$addableitem->id];
    @endphp

    <x-showActions 

        indexroute='addableitem.index'
        editroute='addableitem.edit'
        destroyroute='addableitem.destroy'
        :arg="$arg"

    />
@stop

@section('content')

    @foreach($fields as $field)
        
        <div class="card">
            <h5 class="card-header">{{$field['label']}}</h5>
            <div class="card-body">

                @if($field['type'] == 'image')
                    @if($field['value'] != null)
                        <img src="{{ asset($field['value'][0]) }}" alt="" style="max-width: 200px;">
                    @endif
                @elseif($field['type'] == 'text-area')
                    <p>{!! $field['value'] !!}</p>

                @elseif($field['type'] == 'select')
                    <p>{{ $field['value'][$field['relationship_field']] }}</p>
                @else
                    <p>{{ $field['value'] }}</p>
                @endif

            </div>
        </div>

    @endforeach

@endsection


@section('css')
@stop


@section('js')
<script>
  

</script>
@stop