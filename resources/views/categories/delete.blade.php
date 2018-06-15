{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Vitale Assets | Asset Categorie verwijderen')

@section('content_header')
    <h1>Asset categorie verwijderen</h1>
    {{ Breadcrumbs::render('category', $category) }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- foutmelding -->
            @include('vendor.adminlte.partials.errors')

            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Weet u zeker om de volgende categorie te verwijderen?</h3>
                </div>

                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <th>Naam</th>
                            <td>{{ $category->name }}</td>
                        </tr>
                        <tr>
                            <th>Beschrijving</th>
                            <td>
                                @if($category->description)
                                    {{ $category->description }}
                                @else
                                    {{ '(geen beschrijving)' }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Drempelwaarde</th>
                            <td>
                                @if($category->threshold)
                                    {{ $category->threshold }}
                                @else
                                    {{ '(geen drempelwaarde)' }}
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="box-footer">
                    <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>

                    <div class="pull-right">

                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">

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