{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Vitale Assets | Gebruiker: {{ $user->name }}')

@section('content_header')
    <h1>{{ $user->name }}</h1>
    {{ Breadcrumbs::render('user', $user) }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">User</h3>
                </div>

                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>

                        <tr>
                            <th>Id</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th>Naam</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Rol</th>
                            <td>
                                @foreach ($user->roles as $role)
                                    {{ $role->name }}
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Aangemaakt op:</th>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Aangepast op:</th>
                            <td>{{ $user->updated_at }}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <div class="box-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>

                    <div class="pull-right">
                        <a href="{{ route('users.edit', ['id' => $user->id]) }}" type="button"
                           class="btn btn-warning">
                            Wijzigingen
                        </a>
                        <a href="{{ route('users.delete', ['id' => $user->id]) }}" type="button"
                           class="btn btn-danger">
                            Verwijderen
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>

@stop