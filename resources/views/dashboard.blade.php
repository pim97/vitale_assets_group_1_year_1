@extends('adminlte::page')

@section('title', 'Vitale Assets | Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
    {{ Breadcrumbs::render('dashboard') }}
@stop

@section('content')

    <!-- session -->
    @include('vendor.adminlte.partials.session')

    <!-- dashboard -->
    

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
@stop