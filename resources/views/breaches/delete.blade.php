{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Vitale Assets | Breslocatie verwijderen')

@section('content_header')
    <h1>Breslocatie verwijderen</h1>
    {{ Breadcrumbs::render('breach', $breach) }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- foutmelding -->
            @include('vendor.adminlte.partials.errors')

            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Weet u zeker dat u de breslocatie {{ $breach->name }} wilt verwijderen?</h3>
                </div>

                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th style="width: 25%;">Id</th>
                            <td>{{ $breach->id }}</td>
                        </tr>
                        <tr>
                            <th>Code</th>
                            <td>{{ $breach->code }}</td>
                        </tr>
                        <tr>
                            <th>Naam</th>
                            <td>{{ $breach->name }}</td>
                        </tr>
                        <tr>
                            <th>Langenaam</th>
                            <td>{{ $breach->longname }}</td>
                        </tr>
                        <tr>
                            <th>X-coördinaat</th>
                            <td>{{ $breach->xcoord }}</td>
                        </tr>
                        <tr>
                            <th>Y-coördinaat</th>
                            <td>{{ $breach->ycoord }}</td>
                        </tr>
                        <tr>
                            <th>Dijkring</th>
                            <td>{{ $breach->dykering }}</td>
                        </tr>
                        <tr>
                            <th>VNK2</th>
                            <td>{{ $breach->vnk2 }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="box-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>

                    <div class="pull-right">

                        <form action="{{ route('breaches.destroy', $breach->id) }}" method="POST">
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