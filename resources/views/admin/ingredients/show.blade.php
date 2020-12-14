@extends('adminlte::page')

@php

    $dataType = 'ingredient';

    $data = $ingredient;

    $allFields = config('datatypes.ingredients')['fields'];

@endphp

    @include('admin.partials.show')

@section('css')
@stop

    

@section('js')
<script>
  

</script>
@stop