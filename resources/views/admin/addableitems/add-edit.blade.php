@extends('adminlte::page')

@php

    $dataType = 'addableItem';

    $data = isset($addableitem) ? $addableitem : null;

    $allFields = config('datatypes.addable_items')['fields'];


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
