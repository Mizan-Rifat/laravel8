@extends('adminlte::page')


@php

    $allFields = config('datatypes.products')['fields'];


    $fields = [];

    foreach($allFields as $field){
        if($field['type'] == 'image'){
            $field['value'] = isset($product) ? json_decode($product->image) : [];
        }else{
            $field['value'] = isset($product) ? $product->{$field['field']} : false;

        }
       
       array_push($fields,$field);
    }

@endphp


@section('title', 'Products')

@section('content_header')
    <h1>Products</h1>

    
    @php
        $arg = ['product'=>$product->id];
    @endphp

    <x-showActions 

        indexroute='product.index'
        editroute='product.edit'
        destroyroute='product.destroy'
        :arg="$arg"

    />
@stop

@section('content')


    @foreach($fields as $field)
    
        <div class="card">
            <h5 class="card-header">{{$field['label']}}</h5>
            <div class="card-body">

                @if($field['type'] == 'image')
                    <img src="{{ asset($field['value'][0]) }}" alt="" style="max-width: 200px;">
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