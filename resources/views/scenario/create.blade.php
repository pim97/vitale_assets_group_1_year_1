{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Scenario aanmaken')

@section('content_header')
    <h1>Nieuw scenario aanmaken</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- foutmelding -->
            @include('vendor.adminlte.partials.errors')

            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Scenario aanmaken</h3>
                </div>

                {!! Form::open(['action' => 'ScenariosController@store', 'method' => 'POST']) !!}

                <div class="box-body">
                    <div class="form-group">
                        {{Form::label('name', 'Naam')}}
                        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Hier de naam van het scenario', 'id' => 'name'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('description', 'Beschrijving')}}
                        {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Hier de beschrijving van het scenario', 'id' => 'description'])}}
                    </div>
                </div>

                <div class="box-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>
                    {{Form::submit('Scenario toevoegen', ['class' => 'btn btn-success pull-right'])}}
                </div>

                {!! Form::close() !!}

            </div>

        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop