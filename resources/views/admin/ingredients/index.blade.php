@extends('adminlte::page')

@section('title', 'Ingredients')

@section('content_header')
    <h1>Ingredients</h1>

    <x-topAction route="ingredient.create" />
    
@stop

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    @include('admin.ingredients.table')


@endsection


@section('css')
@stop


@section('js')
<script>
    
</script>
@stop