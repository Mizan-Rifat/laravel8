@extends('adminlte::page')
@php

 $currency_options = [];


 foreach(config('settings.currencies') as $key => $currency){
     array_push($currency_options,[
        'id'=>$key,
        'name'=>$currency['name']
    ]);
 }



@endphp

@section('title', 'Products')

@section('plugins.Select2', true)
@section('plugins.SummerNote', true)

@section('content_header')
    <h1>Products</h1>

    <div class="mt-3 text-right">
        <a class="btn btn-warning m-1" href="{{ route( 'product.index' ) }}">
            <i class="fas fa-list">
            </i>
            Back To List
        </a>
    </div>
@stop

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

                <x-input 
                    label='Name' 
                    name='name' 
                    placeholder='Name' 
                    :value='$product->name'  
                />

                <x-select 
                    label='Category'
                    name='category_id'
                    :options='$categories'
                    :value='$product->category_id'
                />
                <x-multiSelect 
                    label='Ingredients'
                    name='ingredients'
                    :options='$ingredients'
                    :value="$product->ingredients->pluck('id')->toArray()"
                />
                <x-multiSelect 
                    label='Addable Items'
                    name='addableItems'
                    :options='$addableItems'
                    :value="$product->addableItems != null ? $product->addableItems->pluck('id')->toArray() : []"
                   
                />

                <x-gallery 
                    :images='json_decode($product->image)'
                    label='Image'
                />
                <x-imageUploader
                    label='Upload Image'
                />

                <x-editor
                    label='Description' 
                    name='description' 
                    placeholder='Description' 
                    :value='$product->description'  
                />

                <x-input 
                    label='Price' 
                    name='price' 
                    placeholder='Price' 
                    :value='$product->price'  
                />
                <x-select 
                    label='Price Currency'
                    name='price_currency'
                    :options='$currency_options'
                    :value='$product->price_currency'
                />
             

                <x-switch
                    label='Active'
                    name='active'
                    :value='$product->active'

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
