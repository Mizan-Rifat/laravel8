@extends('adminlte::page')

@php

    $dataType = 'role';

    $data = $role ?? null;

    $allFields = config('datatypes.roles')['fields'];

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
