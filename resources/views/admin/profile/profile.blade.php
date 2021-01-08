@extends('adminlte::page')

@section('title', 'profile')

@section('content_header')
    <h1>Profile</h1>
@stop

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    

    @include('admin.profile.content')


@endsection


@section('css')
<style>
    input.hidden{
        opacity:0;
        pointer-events:none;
    }
    .profile-user-img{
        cursor: pointer;

    }
    .input-group-append{
        cursor: pointer;
    }
</style>
@stop


@section('js')
<script>

    $(document).ready(function() {
       

    } );
    
</script>
@stop