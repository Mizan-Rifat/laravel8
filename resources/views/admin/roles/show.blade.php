@extends('adminlte::page')

@php

    $dataType = 'role';

    $data = $role;

    $allFields = config('datatypes.roles')['fields'];

@endphp

    @include('admin.partials.show')

@section('css')
@stop

    

@section('js')
<script>
  

</script>
@stop