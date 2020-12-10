@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <h1>Products</h1>

    <x-topAction route="product.create" />
    
@stop

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif


<x-confirm 
    text='Are you sure to delete the file?'
    type='delete'

/>
@include('admin.products.table')

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