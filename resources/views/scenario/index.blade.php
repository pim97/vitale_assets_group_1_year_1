{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Scenario overzicht')

@section('content_header')
    <h1>Scenario overzicht</h1>
@stop

@section('content')

    <!-- session -->
    @include('vendor.adminlte.partials.session')

    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Overzicht</h3>
                    <a href="{{ route('scenarios.create') }}" class="btn btn-success pull-right">Nieuw scenario aanmaken</a>

                </div>

                <div class="box-body">
                    <table id="scenario-table" class="table table-bordered table-hover dataTable">
                        <thead>
                        <tr>
                            <td><b>Id</b></td>
                            <td><b>Naam</b></td>
                            <td><b>Beschrijving</b></td>
                            <td><b>Wijzigen</b></td>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
    <script src="/js/customDataTables.js"></script>
@stop