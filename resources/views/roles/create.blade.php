@extends('adminlte::page')

@section('title', 'Vitale Assets | Role aanmaken')

@section('content_header')
    <h1>Role aanmaken</h1>
    {{ Breadcrumbs::render('roleCreate') }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- foutmelding -->
            @include('vendor.adminlte.partials.errors')

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                       Role aanmaken
                    </h3>
                </div>

                <form method="POST" action="{{ route('roles.store') }}">

                    @csrf

                    <div class="box-body">
                        <div class="form-group">
                            <label for="roleName">Naam</label>
                            <input type="text" class="form-control" id="roleName" placeholder="Naam" name="name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="roleDescription">Omschrijving</label>
                            <input type="omschrijving" class="form-control" id="roleDescription" placeholder="Omschrijving" name="description" value="{{ old('description') }}">
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>
                        <button type="submit" class="btn btn-success pull-right">Role aanmaken</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

@stop