@extends('adminlte::page')

@section('title', 'Vitale Assets | Asset')

<style>
    .form-control {
        border-radius: 5px !important;
    }

    .table {
        font-size: small !important;
    }
</style>

@section('content_header')
    <h1>Asset</h1>
    {{ Breadcrumbs::render('assets') }}
@stop

@section('content')

    <!-- session -->
    @include('vendor.adminlte.partials.session')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Overzicht van alle assets</h3>
            <a href="{{ route('assets.create') }}" class="btn btn-success pull-right">Asset toevoegen</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div class="row">
                <div class="col-md-12">

                    <table id="assets-table" class="table table-bordered table-hover dataTable">

                        <thead>
                        <tr role="row">
                            <th>#</th>
                            <th>Naam</th>
                            <th>Beschrijving</th>
                            <th>Categorie</th>
                            <th>Drempelwaarde correctie</th>
                            <th>Bewerken</th>
                        </tr>
                        </thead>

                        <tbody id="body"></tbody>

                    </table>

                </div>
            </div>

        </div>
    </div>
    <!-- /.box-body -->

@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
    <script src="../js/allAssets.js"></script>
@stop