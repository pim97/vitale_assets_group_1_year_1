{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::map')

@section('title', 'Vitale Assets | Map prototype')

@section('content')

    <!-- session -->
    @include('vendor.adminlte.partials.session')

    <div id="map" style="width: 100%; height: 100%;"></div>

@stop