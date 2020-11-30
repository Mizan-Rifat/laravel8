@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <h1>Categories</h1>
@stop

@section('content')


@php

  $name = isset($category) ? $category->name : false ;

@endphp

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{isset($category) ? 'Edit' : 'Add' }} Category</h3>
        </div>

        <form method="post" action="{{ isset($category) ? route('category.update') : route('category.store')}}" role="form">
                  @csrf
                <div class="card-body">
               
                  <x-input 
                    label='Name' 
                    name='name' 
                    placeholder='Name' 
                    :value='$name'
                  />


                  @if(isset($category))
                    <input type="hidden" name='id' value="{{$category->id}}">
                  @endif


                </div>
                

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>

    </div>

@endsection


@section('css')

@stop


@section('js')
<script>


</script>
@stop