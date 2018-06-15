@extends('adminlte::page')

@section('title', 'Vitale Assets | Asset categorie wijzigen')

@section('content_header')
    <h1>Asset categorie wijzigen</h1>
    {{ Breadcrumbs::render('category', $category) }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- foutmelding -->
            @include('vendor.adminlte.partials.errors')

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Asset categorie wijzigen</h3>
                </div>

                <form method="POST" action="{{ route('categories.update', $category->id) }}">

                    @method('PUT')
                    @csrf

                    <div class="box-body">
                        <div class="form-group">
                            <label for="assetCategoryName">Naam</label>
                            <input type="text" class="form-control" id="assetCategoryName" placeholder="Naam"
                                   name="name"
                                   value="{{ $category->name }}">
                        </div>

                        <div class="form-group">
                            <label for="assetParentCategory">Hoofdcategorie</label>
                            <select name="parent_id" class="form-control" id="assetParentCategory">

                                <option value="">Geen</option>

                                @foreach($parentCategories as $parentCategory)
                                    @if($parentCategory->id == $category->parent_id)
                                        <option selected value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                    @else
                                        <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                    @endif
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="assetCategoryDescription">Beschrijving</label>
                            <textarea name="description" id="assetCategoryDescription" class="form-control" rows="3"
                                      placeholder="Toelichting van de categorie...">{{ $category->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="assetCategoryThreshold">Drempelwaarde</label>
                            <input type="number" step="any" name="threshold" class="form-control" id="assetCategoryThreshold" placeholder="Drempelwaarde" value="{{ $category->threshold }}">
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>
                        <button type="submit" class="btn btn-success pull-right">Asset Categorie wijzigen</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

@stop