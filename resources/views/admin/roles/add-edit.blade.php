@extends('adminlte::page')

@section('title', 'Roles')

<!-- @section('plugins.Datatables', true) -->

@section('content_header')
    <h1>Roles</h1>
@stop

@section('content')


@php

  $name = isset($role) ? $role->name : false ;
  $display_name = isset($role) ? $role->display_name : false ;

@endphp




<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{isset($role) ? 'Edit' : 'Add' }} Roles</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ isset($role) ? route('roles.update') : route('roles.store')}}" role="form">
                  @csrf
                <div class="card-body">
               
                  <x-input 
                    label='Name' 
                    name='name' 
                    placeholder='Name' 
                    :value='$name' 
                  />
                  <x-input 
                    label='Display Name' 
                    name='display_name' 
                    placeholder='Display Name' 
                    :value='$display_name' 
                  />


                  @if(isset($role))
                    <input type="hidden" name='id' value="{{$role->id}}">
                  @endif

                  <h3>Permissions</h3>

                  @include('admin.roles.partials.checkbox')





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


  function selectAll(e){

    let table = e.dataset.table;

    let checked = e.checked;

    var stockList = $(`.${table}`);

    stockList.each(function() {
        $(this).prop('checked',checked)
    });

  }
   
  


</script>
@stop