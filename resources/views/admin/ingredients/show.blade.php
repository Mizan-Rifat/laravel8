@extends('adminlte::page')

@php

    $allFields = config('datatypes.ingredients')['fields'];


    $fields = [];

    foreach($allFields as $field){
        if($field['type'] == 'image'){
            $field['value'] = isset($ingredient) ? json_decode($ingredient->image) : [];
        }else{
            $field['value'] = isset($ingredient) ? $ingredient->{$field['field']} : false;

        }
       
       array_push($fields,$field);
    }

@endphp

@section('title', 'Ingredients')

@section('content_header')
    <h1>Ingredient</h1>

    @php
        $arg = ['ingredient'=>$ingredient->id];
    @endphp

    <x-showActions 

        indexroute='ingredient.index'
        editroute='ingredient.edit'
        destroyroute='ingredient.destroy'
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
                        @if(array_key_exists('relationship_field',$field))
                            <p>{{ $field['value'][$field['relationship_field']] }}</p>
                        @else
                        <p>{{ $field['value'] }}</p>
                        @endif
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