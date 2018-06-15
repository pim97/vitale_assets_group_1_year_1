@extends('adminlte::page')

@section('title', 'Vitale Assets | Asset categorie aanmaken')

@section('content_header')
    <h1>Asset categorie aanmaken</h1>
    {{ Breadcrumbs::render('categoryCreate') }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- foutmelding -->
            @include('vendor.adminlte.partials.errors')

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Asset categorie aanmaken
                    </h3>
                </div>

                <form method="POST" action="{{ route('categories.store') }}">

                    @csrf

                    <div class="box-body">
                        <div class="form-group">
                            <label for="assetCategoryName">Naam</label>
                            <input type="text" class="form-control" id="assetCategoryName" placeholder="Naam"
                                   name="name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="assetParentCategory">Hoofdcategorie</label>
                            <select name="parent_id" class="form-control" id="assetParentCategory">

                                <option value="" selected>Geen</option>

                                @foreach($categories as $category)
                                    @if(request()->has('hc') && (request()->get('hc') == $category->id))
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="assetCategoryDescription">Beschrijving</label>
                            <textarea name="description" id="assetCategoryDescription" class="form-control" rows="3"
                                      placeholder="Toelichting van de categorie...">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="assetCategoryThreshold">Drempelwaarde</label>
                            <input type="number" step="any" name="threshold" class="form-control" id="assetCategoryThreshold" placeholder="Drempelwaarde" value="{{ old('threshold') }}">
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>
                        <button type="submit" class="btn btn-success pull-right">Asset Categorie toevoegen</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

@stop