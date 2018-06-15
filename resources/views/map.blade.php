@extends('adminlte::page')

@section('title', 'Vitale Assets | Kaart')

@section('content')

    <!-- session -->
    @include('vendor.adminlte.partials.session')

    <!-- map -->
    <div id="map"></div>
    <div class="arrow_box" id="popup-container"></div>

@stop

@section('css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.4/ol-debug.css">
    <style>
        #map {
            width: 100%;
            height: calc(100vh - 50px);
            position: absolute;
        }

        .content {
            padding: 0;
        }

        .content-header {
            display: none;
        }

        .arrow_box {
            border-radius: 5px;
            padding: 10px;
            position: relative;
            background: #fff;
            border: 1px solid #003c88;
        }

        .arrow_box:after, .arrow_box:before {
            top: 100%;
            left: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .arrow_box:after {
            border-color: rgba(255, 255, 255, 0);
            border-top-color: #fff;
            border-width: 10px;
            margin-left: -10px;
        }

        .arrow_box:before {
            border-color: rgba(153, 153, 153, 0);
            border-top-color: #003c88;
            border-width: 11px;
            margin-left: -11px;
        }
    </style>
@stop


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.4/ol-debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.4.4/proj4.js"></script>
    <script src="{{ asset('js/map.js') }}"></script>
@stop
