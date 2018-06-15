{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Vitale Assets | Gebruikers overzicht')

@section('content_header')
    <h1>Rollen</h1>
    {{ Breadcrumbs::render('roles') }}
@stop

@section('content')

    <!-- session -->
    @include('vendor.adminlte.partials.session')

    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Overzicht van alle Rollen</h3>
                    <a href="{{ route('roles.create') }}" class="btn btn-success pull-right">Rol toevoegen</a>
                </div>

                @if(count($roles))
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover">

                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Naam</th>
                                            <th>omschrijving</th>
                                            <th style="width: 120px;">Wijzigingen</th>
                                            <th style="width: 120px;">Verwijderen</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        
                                        @foreach($roles as $role)

                                            <tr>
                                                <td>{{ $role->id }}</td>
                                                <td>
                                                    <a href="{{ route('roles.show', ['role' => $role]) }}">{{ $role->name }}</a>
                                                </td>
                                                <td>{{ $role->description }}</td>
                                                <td>
                                                    <a href="{{ route('roles.edit', ['id' => $role->id]) }}"
                                                       type="button"
                                                       class="btn btn-block btn-warning btn-xs">
                                                        Wijzigingen
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('roles.delete', ['id' => $role->id]) }}"
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
                        Geen Rollen beschikbaar.
                    </div>
                @endif
            </div>
        </div>
    </div>

@stop