{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Vitale Assets | Rol verwijderen')

@section('content_header')
    <h1>Role verwijderen</h1>
    {{ Breadcrumbs::render('role', $role) }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Weet u zeker dat u de volgende rol wilt verwijderen?</h3>
                </div>

                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>

                        <tr>
                            <th>ID</th>
                            <td>{{ $role->id }}</td>
                        </tr>
                        <tr>
                            <th>Naam</th>
                            <td>{{ $role->name }}</td>
                        </tr>
                        <tr>
                            <th>Omschrijving</th>
                            <td>
                                {{ $role->description }}
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <div class="box-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>

                    <div class="pull-right">

                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST">

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