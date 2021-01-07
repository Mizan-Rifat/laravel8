@extends('adminlte::page')

@php

    $allFields = config("datatypes.".pluralDatatype($dataType))['fields'];

@endphp

@section('title', pluralTitle($dataType))

@section('plugins.Select2', true)
@section('plugins.SummerNote', true)

@section('content_header')
<h1>{{ pluralTitle($dataType) }}</h1>


<div class="mt-3 text-right">
    <a class="btn btn-warning m-1" href="{{ route( get_route($dataType,'index')) }}">
        <i class="fas fa-list">
        </i>
        Back To List
    </a>
</div>
@stop


@section('content')

@if ($errors->any())
 @foreach ($errors->all() as $error)
     <div>{{$error}}</div>
 @endforeach
@endif

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{isset($data) ? 'Edit' : 'Add' }} {{ singularTitle($dataType) }} </h3>
    </div>

    @include('admin.partials.form')

</div>

@endsection




@section('css')

@stop

@section('js')
<script>
    $(document).ready(function() {

        
    })
</script>
@stop
