{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Vitale Assets | Role: {{ $role->name }}')

@section('content_header')
    <h1>{{ $role->name }}</h1>
    {{ Breadcrumbs::render('role', $role) }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">Role</h3>
                </div>

                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>

                        <tr>
                            <th>Id</th>
                            <td>{{ $role->id }}</td>
                        </tr>
                        <tr>
                            <th>Naam</th>
                            <td>{{ $role->name }}</td>
                        </tr>
                        <tr>
                            <th>Omschrijving</th>
                            <td>{{ $role->description }}</td>
                        </tr>
                        <tr>
                            <th>Aangemaakt op:</th>
                            <td>{{ $role->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Aangepast op:</th>
                            <td>{{ $role->updated_at }}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <div class="box-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>

                    <div class="pull-right">
                        <a href="{{ route('roles.edit', ['id' => $role->id]) }}" type="button"
                           class="btn btn-warning">
                            Wijzigingen
                        </a>
                        <a href="{{ route('roles.delete', ['id' => $role->id]) }}" type="button"
                           class="btn btn-danger">
                            Verwijderen
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>

@stop