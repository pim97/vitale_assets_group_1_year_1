{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Vitale Assets | Asset')

@section('content_header')
    <h1>Asset: {{ $asset->name }}</h1>
    {{ Breadcrumbs::render('asset', $asset) }}
@stop

@section('content')

    <!-- asset information -->
    <div class="row">
        <div class="col-md-4">

            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Informatie over {{ $asset->name }}</h3>
                </div>

                <div class="box-body">
                    @include("assets.partials.table")
                </div>

                <div class="box-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>

                    <div class="pull-right">
                        <a href='{{ route('assets.edit', ['id' => $asset->id]) }}' class='btn btn-warning'>Wijzigen</a>
                        <a href='{{ route('assets.delete', ['id' => $asset->id]) }}'
                           class='btn btn-danger'>Verwijderen</a>
                    </div>

                </div>

            </div>
        </div>
        <div class="col-md-5">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Kaart</h3>
                </div>
                <div class="box-body">
                    <div id="map" class="map">
                        <div id="popup"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- asset information -->

    <!-- waterdieptes en breslocaties -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Waterdieptes</h3>
                </div>
                <div class="box-body">

                    <div class="nav-tabs-custom">

                        <ul class="nav nav-tabs">
                            @foreach($loadLevels as $count => $loadLevel)
                                <li @if($count == 1) class="active" @endif>
                                    <a href="#loadlevel-{{ $loadLevel->id }}" data-toggle="tab"
                                       data-loadlevel="{{ $loadLevel->id }}" data-asset="{{ $asset->id }}"
                                       aria-expanded="false">
                                        {{ $loadLevel->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content">

                            @foreach($loadLevels as $count => $loadLevel)
                                <div @if($count == 1) class="tab-pane active" @else class="tab-pane"
                                     @endif id="loadlevel-{{ $loadLevel->id }}">
                                    <table class="table table-bordered dataTable asset-breachlocation-waterdepth-table">
                                        <thead>
                                        <tr>
                                            <th>Breslocatie</th>
                                            <th>Waterdiepte</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Breslocatie</th>
                                            <th>Waterdiepte</th>
                                            <th>Status</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- /waterdieptes en breslocaties -->

    <!-- logboek -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">Laatste wijzigingen</h3>
                </div>

                <div class="box-body">

                    <div class="panel-group" id="accordion">
                        @php
                            $index = 0;
                        @endphp

                        @foreach ($logs as $log)

                            @php
                                $d = strval($log->lb_json_data);
                                $obj =json_decode($d);
                                $index++;
                            @endphp

                            @php
                                //set time language to dutch
                                setlocale(LC_TIME, "nl_NL");
                                \Carbon\Carbon::setLocale('nl');
                                //asset changed x time ago
                                $objUpdatedAt = \Carbon\Carbon::parse($obj->updated_at)->diffForHumans();
                                //asset changed timestamp
                                $timeStamp = \Carbon\Carbon::parse($obj->updated_at)->format('d F Y H:i:s');
                            @endphp

                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion"
                                           href="#{{$log->lb_id}}">
                                            <img style="width:15px; height:15px;" class="img-circle"
                                                 src="{{asset('uploads/avatars\\').$log->image_url}}"/>{{$log->username}}
                                            , {{ $objUpdatedAt }} ({{ $timeStamp }})
                                        </a>
                                    </h4>
                                </div>

                                <div id="{{$log->lb_id}}"
                                     class="panel-collapse {{$index == 1 ? 'collapse-in' : 'collapse'}}">
                                    <div class="panel-body table-responsive">

                                        <div class="text-center">
                                            <div class="well well-sm">
                                                <img style="width:70px; height:70px;"
                                                     class="img-circle box_shadow"
                                                     src="{{asset('uploads/avatars\\').$log->image_url}}"/>
                                                <p>Gewijzigd door: {{$log->username}}
                                                    op {{$obj->updated_at}}</p>
                                                <p>De asset data zal worden vervangen door de data hieronder</p>
                                            </div>
                                        </div>


                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Naam</th>
                                                <th>Beschrijving</th>
                                                <th>Categorie</th>
                                                <th>X-coordinaat</th>
                                                <th>Y-coordinaat</th>
                                                <th>Drempelwaarde</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <a href="{{route('assets.show', $obj->id)}}">{{$obj->id == null ? "Niet beschikbaar" : $obj->id}}</a>
                                                </td>
                                                <td>{{$obj->name == null ? "Niet beschikbaar" : $obj->name}}</td>
                                                <td>{{$obj->description == null ? "Niet beschikbaar" : $obj->description}}</td>
                                                <td>{{$obj->category_id == null ? "Niet beschikbaar" : $obj->category_id}}</td>
                                                <td>{{$obj->x_coordinate == null ? "Niet beschikbaar" : $obj->x_coordinate}}</td>
                                                <td>{{$obj->y_coordinate == null ? "Niet beschikbaar" : $obj->y_coordinate}}</td>
                                                <td>{{$obj->threshold_correction == null ? "Niet beschikbaar" : $obj->threshold_correction}}</td>
                                            </tr>

                                            </tbody>
                                        </table>

                                        <a class="btn btn-danger btn-sm pull-right"
                                           href="{{route('logbook.action.revert', $obj->id)}}">Wijziging
                                            verwijderen</a>
                                        <a class="btn btn-warning btn-sm pull-right"
                                           href="{{route('logbook.action.revert', $obj->id)}}">Wijziging
                                            terugzetten</a>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /logboek -->

@stop

@section('css')
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
    <style>
        .map {
            height: 389px;
            width: 100%;
            position: relative;
        }

        .btn {
            margin-left: 5px;
        }

        .box_shadow {
            margin: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
    </style>
@stop

@section('js')
    <script>
        //define asset information for js files
        window.assetId = '{{ $asset->id }}';
        window.assetName = '{{ $asset->name }}';
        window.assetXCoord = '{{ $asset->x_coordinate }}';
        window.assetYCoord = '{{ $asset->y_coordinate }}';
    </script>
    <script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>
    <script src="{{ asset('js/assetShow.js') }}"></script>
    <script src="{{ asset('js/assetBreachlocationsTable.js') }}"></script>
@stop