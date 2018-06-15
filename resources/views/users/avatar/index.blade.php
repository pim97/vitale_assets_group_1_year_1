{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Vitale Assets | Gebruikers overzicht')

@section('content_header')
    <h1>Avatar configuratie</h1>
    {{ Breadcrumbs::render('avatar') }}
@stop

@section('content')

    <!-- session -->
    @include('vendor.adminlte.partials.session')

    <div class="row">

        <div class="col-md-6">
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Huidige avatar</h3>
                </div>

                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <p>Dit is je huidig ingestelde avatar</p>
                        <div class="row">
                            <div class="col-sm-12">
                                <div style="text-align:center;">

                                    <img class="img-circle" src="{{$avatar_url}}"
                                         style="width:200px; height:200px; border-radius:50%;">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Wijzig je avatar</h3>
                </div>

                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <p>Je kunt hier een nieuwe avatar instellen, kies een bestand an klik save</p>
                        <div class="row">
                            <div class="col-sm-12">

                                <form enctype="multipart/form-data" href="{{action('AvatarController@store')}}"
                                      method="POST">
                                    <input type="file" name="avatar">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" value="Save" class="pull-right btn btn-sm btn-primary">
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Je laatst gebruikte avatars</h3>
                </div>

                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                        @if (isset($avatars_urls))
                            <p>Je hebt op het moment nog geen avatars opgeslagen</p>
                        @else
                            <p>Je kunt op deze avatars klikken om deze avatar weer te gebruiken</p>
                        @endif

                        <div class="row">
                            <div class="col-sm-12">


                                @foreach ($avatars_urls as $avatar)
                                    <a href="{{route('users.avatar.update', [$avatar->id])}}">
                                        <img style="margin:10px; width:120px;" class="img-circle"
                                             src="{{asset('uploads/avatars\\')}}{{$avatar->image_url}}">
                                    </a>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop