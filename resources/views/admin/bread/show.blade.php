@extends('adminlte::page')

@php

    $allFields = config("datatypes.".pluralDatatype($dataType))['fields'];

@endphp

    @include('admin.partials.show')

@section('css')
@stop

@section('js')
<script>
  

</script>
@stop