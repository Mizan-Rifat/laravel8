@extends('adminlte::page')

@section('title', 'Roles')

<!-- @section('plugins.Datatables', true) -->

@section('content_header')
    <h1>Roles</h1>

    @php
        $arg = ['role'=>$role->id];
    @endphp

    <x-showActions 

        indexroute='roles.index'
        editroute='roles.edit'
        destroyroute='roles.destroy'
        :arg="$arg"

    />
@stop

@section('content')

    <div class="card">
        <h5 class="card-header">Name</h5>
        <div class="card-body">
            <p>{{$role->name}}</p>
        </div>
    </div>

    <div class="card">
        <h5 class="card-header">Display Name</h5>
        <div class="card-body">
            <p>{{$role->display_name}}</p>
        </div>
    </div>

@endsection


@section('css')
@stop


@section('js')
<script>
  

</script>
@stop