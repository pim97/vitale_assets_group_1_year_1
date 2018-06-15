@extends('adminlte::page')

@section('title', 'Vitale Assets | Breslocatie aanmaken')

@section('content_header')
    <h1>Breslocatie aanmaken</h1>
    {{ Breadcrumbs::render('breachCreate') }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- foutmelding -->
            @include('vendor.adminlte.partials.errors')

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Toevoegen
                    </h3>
                </div>

                <form method="POST" action="{{ route('breaches.store') }}">

                    @csrf

                    <div class="box-body">

                        <div class="form-group">
                            <label for="breachLocationCode">Code</label>
                            <input type="text" class="form-control" id="breachLocationCode" placeholder="Code" name="code" value="{{ old('code') }}">
                        </div>

                        <div class="form-group">
                            <label for="breachLocationName">Naam</label>
                            <input type="text" class="form-control" id="breachLocationName" placeholder="Naam" name="name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="breachLocationLongname">Langenaam</label>
                            <input type="text" class="form-control" id="breachLocationLongname" placeholder="Langenaam" name="longname" value="{{ old('longname') }}">
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="breachLocationXcoord">X-coördinaat</label>
                                    <input type="number" class="form-control" id="breachLocationXcoord" placeholder="X-coördinaat" name="x_coordinate" value="{{ old('x_coordinate') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="breachLocationYcoord">Y-coördinaat</label>
                                    <input type="number" class="form-control" id="breachLocationYcoord" placeholder="Y-coördinaat" name="y_coordinate" value="{{ old('y_coordinate') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="breachLocationDykring">Dijkring</label>
                                    <input type="number" class="form-control" id="breachLocationDykring" placeholder="Dijkring" name="dykering" value="{{ old('dykering') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="breachLocationVNK2">VNK2</label>
                                    <input type="number" class="form-control" id="breachLocationVNK2" placeholder="VNK2" name="vnk2" value="{{ old('vnk2') }}">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>
                        <button type="submit" class="btn btn-success pull-right">Breslocatie toevoegen</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

@stop