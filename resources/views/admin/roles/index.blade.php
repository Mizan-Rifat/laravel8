@extends('adminlte::page')

@php

    $dataType = 'role';

    $data = $roles;

    $allFields = config('datatypes.roles')['fields'];

@endphp

@section('title', pluralTitle($dataType))

@section('content_header')
    <h1>{{ pluralTitle($dataType) }}</h1>

    <x-topAction :route="get_route('roles','create')" />
    
@stop

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

@include('admin.partials.table')

@endsection


@section('css')
@stop


@section('js')
<script>

$(document).ready(function() {
        $('#example').DataTable( {
            "order": [],
            'columnDefs': [
                {
                    'targets': 0,
                    'searchable':false,
                    'orderable':false,

                },
            ],
        });


        $('#deleteBtn').click(function(e) {
            e.preventDefault();
            $('#myTable').submit();
        })
        
        $('#bulkSelect').click(function(e) {
         
                $('.checkboxes').each(function() {
                    $(this).prop('checked',e.target.checked)
                });
            
        })


    } );
    
</script>
@stop