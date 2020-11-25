@extends('adminlte::page')

@section('title', 'Dashboard')
@section('plugins.Chartjs', true)


@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    @include('admin.dashboard.widgets')
    @include('admin.dashboard.chart')
    @include('admin.dashboard.map')
    

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  @include('admin.dashboard.script')
@stop