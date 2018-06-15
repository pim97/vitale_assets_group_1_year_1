@extends('adminlte::page')

@section('title', 'Vitale Assets | Breslocatie wijzigen')

@section('content_header')
    <h1>Breslocaties wijzigen</h1>
    {{ Breadcrumbs::render('breach', $breach) }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">

            @include('vendor.adminlte.partials.errors')

            <div class="box">

                <div class="box-header with-border">
                    <div class="box-title">Wijzigen van breslocatie "{{$breach->name}}"</div>
                </div>

                <form action="{{route('breaches.update', $breach->id)}}" method="post">

                    @method('PUT')
                    @csrf

                    <div class="box-body">

                        <div class="form-group">
                            <label for="breachLocationCode">Code</label>
                            <input type="text" class="form-control" id="breachLocationCode" placeholder="Code"
                                   name="code" value="{{ $breach->code }}">
                        </div>

                        <div class="form-group">
                            <label for="breachLocationName">Naam</label>
                            <input type="text" class="form-control" id="breachLocationName" placeholder="Naam"
                                   name="name" value="{{ $breach->name }}">
                        </div>

                        <div class="form-group">
                            <label for="breachLocationLongname">Langenaam</label>
                            <input type="text" class="form-control" id="breachLocationLongname" placeholder="Langenaam"
                                   name="longname" value="{{ $breach->longname }}">
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="breachLocationXcoord">X-coördinaat</label>
                                    <input type="number" class="form-control" id="breachLocationXcoord"
                                           placeholder="X-coördinaat" name="x_coordinate" value="{{ $breach->xcoord }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="breachLocationYcoord">Y-coördinaat</label>
                                    <input type="number" class="form-control" id="breachLocationYcoord"
                                           placeholder="Y-coördinaat" name="y_coordinate" value="{{ $breach->ycoord }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="breachLocationDykring">Dijkring</label>
                                    <input type="number" class="form-control" id="breachLocationDykring"
                                           placeholder="Dijkring" name="dykering" value="{{ $breach->dykering }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="breachLocationVNK2">VNK2</label>
                                    <input type="number" class="form-control" id="breachLocationVNK2" placeholder="VNK2"
                                           name="vnk2" value="{{ $breach->vnk2 }}">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <a href="{{URL::previous()}}" class="btn btn-default btn-detail open-modal">Terug</a>
                        <button type="submit" class="btn btn-success pull-right">Wijzigen</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop