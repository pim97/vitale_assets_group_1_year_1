{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Vitale Assets | Gebruiker verwijderen')

@section('content_header')
    <h1>Gebruiker verwijderen</h1>
    {{ Breadcrumbs::render('user', $user) }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Weet u zeker dat u de volgende gebruiker wilt verwijderen?</h3>
                </div>

                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>

                        <tr>
                            <th>ID</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th>Naam</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                {{ $user->email }}
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <div class="box-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>

                    <div class="pull-right">

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">

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