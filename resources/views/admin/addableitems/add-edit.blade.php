@extends('adminlte::page')

@section('title', 'Addable Items')
@section('plugins.Select2', true)
@section('plugins.SummerNote', true)

@php

    $allFields = config('datatypes.addable_items')['fields'];

    $currencys = config('settings.currencies');


    $array = [];

    foreach($currencys as $key => $currency){
        $bal = [
            'id'=>$key,
            'name'=>$currency['name'],
        ];
        array_push($array,$bal);
    }

    $currency_options = json_decode(json_encode($array));




    $fields = [];

    foreach($allFields as $field){
        if($field['type'] == 'image'){
            $field['value'] = isset($addableitem) ? json_decode($addableitem->image) : [];
        }else{
            $field['value'] = isset($addableitem) ? $addableitem->{$field['edit_field']} : false;

        }
       
       array_push($fields,$field);


     
       
    }
@endphp

@section('content_header')
    <h1>AddableItems</h1>
@stop

@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{isset($addableitem) ? 'Edit' : 'Add' }} Addable Item</h3>
        </div>


        <form 
            method="post" 
            action="{{ isset($addableitem) ? route('addableitem.update') : route('addableitem.store')}}" 
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
                        $column = $field['column'];
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
                            :options='$currency_options'
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
                    @if($field['value'] != null)
                        <x-gallery 
                            :images='$value'
                            :label='$label'
                        />
                        @endif
                        <x-imageUploader
                            label='Upload Image'
                            :value='$value'  
                        />

                    @endif



                @endforeach

                @if(isset($addableitem))
                    <input type="hidden" name='id' value="{{$addableitem->id}}">
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


</script>
@stop