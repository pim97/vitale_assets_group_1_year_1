@extends('adminlte::page')

@section('title', 'Vitale Assets | Nieuwsberichten aanmaken')

@section('content_header')
    <h1>Nieuwsbericht aanmaken</h1>
    {{ Breadcrumbs::render('newsCreate') }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- foutmelding -->
            @include('vendor.adminlte.partials.errors')

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Nieuwsbericht aanmaken
                    </h3>
                </div>

                <form method="POST" action="{{ route('news.store') }}">

                    @csrf

                    <div class="box-body">
                        <div class="form-group">
                            <label for="username">Titel</label>
                            <input type="text" class="form-control" id="username" placeholder="Titel" name="title" value="{{ old('title') }}">
                        </div>

                        <div class="form-group">
                            <label for="newspostCategory">Categorie</label>
                            <select name="news_category_id" class="form-control" id="newspostCategory">
                                <option selected disabled value="">Selecteer een categorie</option>
                                @foreach($newsCategories as $newsCategory)
                                    <option value="{{$newsCategory->id}}">{{$newsCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="newsMessage">Bericht</label>
                            <textarea name="message" id="message" class="form-control" rows="3" placeholder="Bericht...">{{ old('message') }}</textarea>
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>
                        <button type="submit" class="btn btn-success pull-right">Nieuwsbericht toevoegen</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

@stop