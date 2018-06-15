{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Vitale Assets | Scenario verwijderen')

@section('content_header')
    <h1>Scenario verwijderen</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- foutmelding -->
            @include('vendor.adminlte.partials.errors')

            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Weet u zeker om de volgende scenario te verwijderen?</h3>
                </div>

                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>

                        <tr>
                            <th>ID</th>
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

                        <form action="{{ action('ScenariosController@destroy', ['id' => $scenario->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf

                            <button class="btn btn-danger" type="submit">
                                Definitief verwijderen
                            </button>
                        </form>


                    </div>

                </div>

            </div>
        </div>
    </div>

@stop