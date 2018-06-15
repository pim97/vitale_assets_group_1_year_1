{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Vitale Assets | Scenarios')

@section('content_header')
    <h1>Scenario overzicht</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">{{$scenario->name}}</h3>
                </div>

                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>

                        <tr>
                            <th>Id</th>
                            <td>{{ $scenario->id }}</td>
                        </tr>
                        <tr>
                            <th>Naam</th>
                            <td>{{ $scenario->name }}</td>
                        </tr>

                        <tr>
                            <th>Beschrijving</th>
                            <td>
                                @if($scenario->description)
                                    {{ $scenario->description }}
                                @else
                                    {{ '(geen beschrijving)' }}
                                @endif
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <div class="box-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>


                    <div class="pull-right">
                        <a href="{{route('scenarios.edit', ['id' => $scenario->id])}}" type="button"
                           class="btn btn-warning">
                            Wijzigingen
                        </a>
                        <a href="{{action('ScenariosController@delete', ['id' => $scenario->id])}}" type="button"
                           class="btn btn-danger">
                            @csrf
                            Verwijderen
                        </a>
                    </div>


                </div>

            </div>
        </div>
    </div>


@stop