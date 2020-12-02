@extends('adminlte::page')

@section('title', 'Products')

@section('plugins.Select2', true)
@section('plugins.SummerNote', true)

@section('content_header')
    <h1>Products</h1>
@stop

@php

    $allFields = config('datatypes.products')['fields'];


    $fields = [];

    foreach($allFields as $field){
        if($field['type'] == 'image'){
            $field['value'] = isset($product) ? json_decode($product->image) : [];
        }else{
            $field['value'] = isset($product) ? $product->{$field['title']} : false;

        }
       
       array_push($fields,$field);


       
    }


@endphp

@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{isset($product) ? 'Edit' : 'Add' }} Product</h3>
        </div>


        <form 
            method="post" 
            action="{{ isset($product) ? route('product.update') : route('product.store')}}" 
            role="form"
            enctype="multipart/form-data"
        >
            
            @csrf
            <div class="card-body">

                @foreach($fields as $field)

                    @php
                        $label = $field['label'];
                        $type = $field['type'];
                        $value = $field['value'];
                    @endphp

                    @if($field['type'] == 'text')
                        <x-input 
                            :label='$label' 
                            :name='strtolower($label)' 
                            :placeholder='$label' 
                            :value='$value'  
                        />

                    @endif

                    @if($field['type'] == 'select')
                        <x-select 
                            :label='$label'
                            :options='$categories'
                            :name='strtolower($label)'
                            :value='$value'  
                        />

                    @endif

                    @if($field['type'] == 'text-area')
                        <x-editor
                            :label='$label'
                            :name='strtolower($label)' 
                            :value='$value'  
                        />

                    @endif

                    @if($field['type'] == 'switch')
                        <x-switch
                            :label='$label'
                            :name='strtolower($label)' 
                            :value='$value'  
                        />

                    @endif

                    @if($field['type'] == 'image')
                        <x-gallery 
                            :images='$value'
                            :label='$label'
                        />
                        <x-imageUploader
                            label='Upload Image'
                            :value='$value'  
                        />

                    @endif



                @endforeach


                <x-gallery 
                    ':images'=
                />


            
                
                


                @if(isset($product))
                    <input type="hidden" name='id' value="{{$product->id}}">
                @endif


            </div>
            

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>

    </div>

    

    

@endsection


@section('css')

@stop


@section('js')
<script>
    $(document).ready(function() {
        
        
        
    })



</script>
@stop