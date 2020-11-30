@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <h1>Categories</h1>

    @php
        $arg = ['category'=>$category->id];
    @endphp

    <x-showActions 

        indexroute='category.index'
        editroute='category.edit'
        destroyroute='category.destroy'
        :arg="$arg"

    />
@stop

@section('content')

<div class="card">
        <h5 class="card-header">Name</h5>
        <div class="card-body">
            <p>{{$category->name}}</p>
        </div>
    </div>

@endsection


@section('css')
@stop


@section('js')
<script>
  

</script>
@stop