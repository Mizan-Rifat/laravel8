@extends('adminlte::page')

@php

    $dataType = 'ingredient';

    $data = isset($ingredient) ? $ingredient : null;

    $allFields = config('datatypes.ingredients')['fields'];

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
