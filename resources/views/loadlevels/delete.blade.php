{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Vitale Assets | Belastingniveau verwijderen')

@section('content_header')
    <h1>Belastingniveau verwijderen</h1>
    {{ Breadcrumbs::render('loadlevel', $loadlevel) }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- foutmelding -->
            @include('vendor.adminlte.partials.errors')

            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Weet u zeker dat u het belastingniveau "{{ $loadlevel->name }}" wilt verwijderen?</h3>
                </div>

                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th style="width: 25%;">Id</th>
                            <td>{{ $loadlevel->id }}</td>
                        </tr>
                        <tr>
                            <th>Code</th>
                            <td>{{ $loadlevel->code }}</td>
                        </tr>
                        <tr>
                            <th>Naam</th>
                            <td>{{ $loadlevel->name }}</td>
                        </tr>
                        <tr>
                            <th>Beschrijving</th>
                            <td>
                                @if($loadlevel->description)
                                    {{ $loadlevel->description }}
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

                        <form action="{{ route('loadlevels.destroy', $loadlevel) }}" method="POST">
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