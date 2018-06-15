@extends('adminlte::page')

@section('title', 'Vitale Assets | Rol wijzigen')

@section('content_header')
    <h1>Rol wijzigen</h1>
    {{ Breadcrumbs::render('role', $role) }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- foutmelding -->
            @include('vendor.adminlte.partials.errors')

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Rol wijzigen
                    </h3>
                </div>

                <form method="POST" action="{{ route('roles.update', $role->id) }}">

                    @method('PUT')
                    @csrf

                    <div class="box-body">

                        <div class="form-group">
                            <label for="name">Naam</label>
                            <input type="text" class="form-control" id="name" placeholder="Naam" name="name" value="{{ $role->name }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Omschrijving</label>
                            <input type="text" class="form-control" id="description" placeholder="Omschrijving" name="description" value="{{ $role->description }}">
                        </div>

                    </div>

                    <div class="box-footer">
                        <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>
                        <button type="submit" class="btn btn-success pull-right">Rol wijzigen</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

@stop