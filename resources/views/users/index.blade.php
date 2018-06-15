{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Vitale Assets | Gebruikers overzicht')

@section('content_header')
    <h1>Gebruikers</h1>
    {{ Breadcrumbs::render('users') }}
@stop

@section('content')

    <!-- session -->
    @include('vendor.adminlte.partials.session')

    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Overzicht van alle gebruikers</h3>
                    <a href="{{ route('users.create') }}" class="btn btn-success pull-right">Gebruiker toevoegen</a>
                </div>

                @if(count($users))
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover">

                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Naam</th>
                                            <th>Email</th>
                                            <th>Rol</th>
                                            <th>Aangemaakt op</th>
                                            <th>Laatst aangepast op</th>
                                            <th style="width: 120px;">Wijzigingen</th>
                                            <th style="width: 120px;">Verwijderen</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        
                                        @foreach($users as $user)

                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>
                                                    <a href="{{ route('users.show', ['user' => $user]) }}">{{ $user->name }}</a>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @foreach ($user->roles as $role)
                                                        {{ $role->name }}
                                                    @endforeach
                                                </td>
                                                <td>{{ $user->created_at }}</td>
                                                <td>{{ $user->updated_at }}</td>
                                                <td>
                                                    <a href="{{ route('users.edit', ['id' => $user->id]) }}"
                                                       type="button"
                                                       class="btn btn-block btn-warning btn-xs">
                                                        Wijzigingen
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('users.delete', ['id' => $user->id]) }}"
                                                       type="button"
                                                       class="btn btn-block btn-danger btn-xs">
                                                        Verwijderen
                                                    </a>
                                                </td>
                                            </tr>

                                        @endforeach

                                        </tbody>

                                        <tfoot>

                                        </tfoot>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                @else
                    <div class="box-body">
                        Geen gebruikers beschikbaar.
                    </div>
                @endif
            </div>
        </div>
    </div>

@stop