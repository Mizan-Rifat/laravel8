@extends('adminlte::page')

@php


    $dataType = 'category';

    $data = $category;

    $allFields = config('datatypes.categories')['fields'];

@endphp

    @include('admin.partials.show')

@section('css')
@stop

    

@section('js')
<script>
  

</script>
@stop