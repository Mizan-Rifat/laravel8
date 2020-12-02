@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <h1>Products</h1>

    @php
        $arg = ['product'=>$product->id];
    @endphp

    <x-showActions 

        indexroute='products.index'
        editroute='products.edit'
        destroyroute='products.destroy'
        :arg="$arg"

    />
@stop

@section('content')

    

@endsection


@section('css')
@stop


@section('js')
<script>
  

</script>
@stop