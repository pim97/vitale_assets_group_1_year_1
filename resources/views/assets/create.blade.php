@extends('adminlte::page')

@section('title', 'Vitale Assets | Asset aanmaken')

@section('content_header')
    <h1>Asset aanmaken</h1>
    {{ Breadcrumbs::render('assetCreate') }}
@stop

@section('content')

    <div class="row">
        <div class="col-sm-6">

            <!-- foutmelding -->
            @include('vendor.adminlte.partials.errors')

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Invoeren</h3>
                </div>

                @include("assets.partials.form_create")

            </div>

        </div>

        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Uploaden
                    </h3>
                </div>

                <div class="box-body">
                    <!--put your div body in here-->
                </div>

            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
    <script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>
    <script src="{{ asset('js/assetCreate.js') }}"></script>
    <script src="{{ asset('js/thresholdCheck.js') }}"></script>
@stop