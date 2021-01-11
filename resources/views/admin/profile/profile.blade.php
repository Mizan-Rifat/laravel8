@extends('adminlte::page')

@section('title', 'profile')

@section('plugins.Cropme', true)

@section('content_header')
    <h1>Profile</h1>
@stop

@section('content')
@if ($errors->any())
 @foreach ($errors->all() as $error)
     <div>{{$error}}</div>
 @endforeach
@endif

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
        width: 20px;
    }
    button.hidden{
        display:none;
    }
    #cancelEditBtn,#saveBtn{
        padding: 5px;
    }
    .profile-user-img{
        cursor: pointer;
        border-radius: 50%;
        border: none;
        padding: 0;
    }
    .input-group-append{
        cursor: pointer;
    }
    #spinner{
        display: none;
    }

    .img-circle{
        height: 100px;
        width: 100px;
        border: 3px solid #adb5bd;
        border-radius: 50%;
        overflow: hidden;
        
    }
    
</style>
@stop


@section('js')
<script>

    $(document).ready(function() {
       

    } );
    
</script>
@stop