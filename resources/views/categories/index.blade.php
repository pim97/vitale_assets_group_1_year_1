@extends('adminlte::page')

@section('title', 'Vitale Assets | Asset categorie overzicht')

@section('content_header')
    <h1>Asset categorieën</h1>
    {{ Breadcrumbs::render('categories') }}
@stop

@section('content')

    <!-- session -->
    @include('vendor.adminlte.partials.session')

    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">Overzicht van alle asset hoofdcategorieën</h3>
                </div>

                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-5">
                            <!-- search form -->
                            <div class="btn-group">
                                <a href="{{ route('categories.index', ['f' => 'main']) }}" type="button" class="btn btn-default">Hoofdcategorieën</a>
                                <a href="{{ route('categories.index') }}" type="button" class="btn btn-default">Alle categorieën</a>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="row">

                                <div class="col-xs-5 col-xs-offset-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <input type="search" id="searchField" class="form-control" name="search"
                                               placeholder="Naam of beschrijving">
                                        <span class="input-group-btn">
                                                <button type="button" class="btn btn-default btn-flat">Zoeken</button>
                                            </span>
                                    </div>
                                </div>

                                <div class="col-xs-3">
                                    <a href="{{ route('categories.create') }}" class="btn btn-success pull-right">Asset
                                        categorie toevoegen</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                @if(count($categories))

                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                            @include('categories.partials.table-index')

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_info" id="example2_info">
                                        Toont <span id="first_item">{{ $categories->firstItem() }}</span> t/m <span
                                                id="last_item">{{ $categories->lastItem() }}</span> van de <span
                                                id="total">{{ $categories->total() }}</span> categorieën
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="dataTables_paginate paging_simple_numbers">
                                        {!! $categories->appends(\Request::except('page'))->render() !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                @else
                    <div class="box-body">
                        Geen asset categorieën beschikbaar.
                    </div>
                @endif

            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
    @include('categories.partials.ajax-index')
@stop