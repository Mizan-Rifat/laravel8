@extends('adminlte::page')

@php

    $dataType = 'category';

    $data = isset($category) ? $category : null;

    $allFields = config('datatypes.categories')['fields'];

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
