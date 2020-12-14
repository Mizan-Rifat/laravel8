@extends('adminlte::page')

@php

    $dataType = 'addableItem';

    $data = $addableitem;

    $allFields = config('datatypes.addable_items')['fields'];

@endphp

    @include('admin.partials.show')

@section('css')
@stop

    

@section('js')
<script>
  

</script>
@stop