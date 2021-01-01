@extends('adminlte::page')

@php

    $allFields = config("datatypes.".pluralDatatype($dataType))['fields'];

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
