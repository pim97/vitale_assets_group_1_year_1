{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Scenario bewerken')

@section('content_header')
    <h1>Scenario wijzigen</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- foutmelding -->
            @include('vendor.adminlte.partials.errors')

            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Scenario Bewerken</h3>
                </div>

                {!! Form::open(['action' => ['ScenariosController@update', $scenario->id], 'method' => 'POST']) !!}

                <div class="box-body">
                    {{Form::hidden('_method', 'PUT')}}

                    <div class="form-group">
                        {{Form::label('name', 'Naam')}}
                        {{Form::text('name', $scenario->name, ['class' => 'form-control'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('description', 'Beschrijving')}}
                        {{Form::textarea('description', $scenario->description, ['class' => 'form-control'])}}
                    </div>
                </div>

                <div class="box-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>
                    {{Form::submit('Scenario wijzigen', ['class' => 'btn btn-success pull-right'])}}
                </div>

                {!! Form::close() !!}

            </div>

        </div>
    </div>

@stop