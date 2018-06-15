@extends('adminlte::page')

@section('title', 'Vitale Assets | Gebruiker wijzigen')

@section('content_header')
    <h1>Gebruiker wijzigen</h1>
    {{ Breadcrumbs::render('user', $user) }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- foutmelding -->
            @include('vendor.adminlte.partials.errors')

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Gebruiker wijzigen
                    </h3>
                </div>

                <form method="POST" action="{{ route('users.update', $user->id) }}">

                    @method('PUT')
                    @csrf

                    <div class="box-body">

                        <div class="form-group">
                            <label for="name">Naam</label>
                            <input type="text" class="form-control" id="name" placeholder="Naam" name="name" value="{{ $user->name }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ $user->email }}">
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="role">Role</label>

                            <!-- <br> -->
                            <!-- @foreach($user->roles as $role) -->
                            <!-- <label for="user_role"> {{ $role->name }} </label> -->
                            <!-- @endforeach -->


                            <select name="role[]" class="form-control select2" id="role" multiple="multiple">
                                    @foreach($roles as $role)
                                        @if($user->hasRoles($role))
                                            <option value="{{ $role->id }}" selected="selected">
                                                {{$role->name}}
                                            </option>
                                        @else
                                            <option value="{{ $role->id }}">
                                               {{ $role->name }}
                                            </option>
                                        @endif
                                    @endforeach
                            </select>
                        </div>                         

                        <div class="form-group">
                            <label for="password">Wachtwoord</label>
                            <input type="password" class="form-control" id="password" placeholder="Wachtwoord" name="password"  value="{{ $user->password }}">
                        </div>

                    </div>

                    <div class="box-footer">
                        <a href="{{ URL::previous() }}" class="btn btn-default">Terug</a>
                        <button type="submit" class="btn btn-success pull-right">Gebruiker wijzigen</button>
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
