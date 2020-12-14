@extends('adminlte::page')

@php

    $dataType = 'product';

    $data = $product;

    $allFields = config('datatypes.products')['fields'];

@endphp

    @include('admin.partials.show')

@section('css')
@stop

    

@section('js')
<script>
  

</script>
@stop