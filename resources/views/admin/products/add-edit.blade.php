@extends('adminlte::page')

@php

    $dataType = 'product';

    $data = isset($product) ? $product : null;

    $allFields = config('datatypes.products')['fields'];


@endphp


@include('admin.partials.add-edit')

@section('css')

@stop

@section('js')
<script>
    $(document).ready(function() {
        
    })
</script>
@stop
