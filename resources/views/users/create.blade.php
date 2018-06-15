@extends('adminlte::page')

@section('title', 'Vitale Assets | Gebruiker aanmaken')

@section('content_header')
    <h1>Gebruiker aanmaken</h1>
    {{ Breadcrumbs::render('userCreate') }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- foutmelding -->
            @include('vendor.adminlte.partials.errors')

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Gebruiker aanmaken
                    </h3>
                </div>

                <form method="POST" action="{{ route('users.store') }}">

                    @csrf

                    <div class="box-body">
                        <div class="form-group">
                            <label for="userName">Naam</label>
                            <input type="text" class="form-control" id="userName" placeholder="Naam" name="name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="userEmail">Email</label>
                            <input type="email" class="form-control" id="userEmail" placeholder="Email" name="email" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role[]" class="form-control select2" id="role" multiple="multiple">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="password">Wachtwoord</label>
                            <input type="password" class="form-control" id="password" placeholder="Wachtwoord" name="password">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Wachtwoord bevestigen</label>
                            <input type="password" class="form-control" id="password_confirmation" placeholder="Wachtwoord bevestigen" name="password_confirmation">
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>
                        <button type="submit" class="btn btn-success pull-right">Gebruiker aanmaken</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@stop

@section('js')   
    <script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
    </script>
@stop
