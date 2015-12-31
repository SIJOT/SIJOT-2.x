<!DOCTYPE html>
<html lang="nl">
    <head>
        {{-- Import header component --}}
        @include('partials.header')
    </head>
    <body>
        {{-- Import navigation component --}}
        @include('partials.navbar')

        <div class="container">
            <div class="row">
                <div class="col-sm-10">
                    <h1> {{ $username }} </h1>
                </div>
                <div class="col-sm-2">
                    <a href="/users" class="pull-right">
                        @if(isset($avatar) && ! empty($avatar))
                            <img title="profile image" class="img-circle size-img img-responsive" src="{{ $avatar }}">
                        @else
                            <img title="profile image" class="img-circle size-img img-responsive" src="http://www.gravatar.com/avatar/28fd20ccec6865e2d5f0e1f4446eb7bf?s=100">
                        @endif
                    </a>
                </div>
            </div>

            <div class="row"> {{-- row --}}
                <div class="col-sm-3"> {{-- left col --}}

                    <ul class="list-group">
                        <li class="list-group-item text-muted">Profile</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Joined</strong></span> 2.13.2014</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Last seen</strong></span> Yesterday</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Real name</strong></span> Joseph Doe</li>
                    </ul>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Gebruikersgroepen:
                            <i class="fa fa-link fa-1x"></i>
                        </div>
                        <div class="panel-body">
                            @foreach($user_groups as $value)
                               <!-- List labels -->
                            @endforeach
                        </div>
                    </div>

                </div>{{-- end col-3 --}}
                <div class="col-sm-9">

                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                        <li><a href="#messages" data-toggle="tab">Messages</a></li>
                        <li><a href="#permissions" data-toggle="tab">Gebruikersrechten</a></li>
                        <li><a href="#configuration" data-toggle="tab">Account configuration</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                        </div>{{-- End tab-pane --}}

                        <div class="tab-pane" id="permissions">
                            <div style="padding-top: 10px;" class="row">
                                <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6">
                                    <table class="table table-condensed table-bordered">
                                        <thead>
                                            <tr>
                                                <th> Recht type: </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="{{ route("acl.PermissionsUpdate", ['id' => $id]) }}" method="post">
                                                {{-- csrf field --}}
                                                {{ csrf_field() }}

                                                @foreach($permission as $right)
                                                    <tr>
                                                        <td>Login beheer</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" name="ledenbeheer" value="1" @if($right->ledenbeheer === 1) checked @endif>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Verhuur beheer</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" name="verhuurbeheer" value="1" @if($right->verhuurbeheer === 1) checked @endif>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>SIJOT cloud</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" name="" value="1" @if($right->cloud === 1) checked @endif>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>SIJOT media</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" name="" value="1" @if($right->media === 1) checked @endif>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <button type="submit" class="btn btn-success">
                                            Aanpassen
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>{{-- END tab-pane  --}}

                        <div class="tab-pane" id="configuration">
                            <div style="padding-top: 10px;" class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="/backend/acl/changeCredentials/{{ $id }}" enctype="multipart/form-data">
                                        {!! Form::open(['url' => '/backend/acl/changeCredentials/' .$id, 'files' => true]) !!}

                                        {{-- CSRF token --}}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <label for="Naam">Naam:</label>
                                        <input style="width: 32%;" name="gebruikers_naam" class="form-control" type="text" value="{{ $username }}">
                                        <br>

                                        <label for="Email">Email</label>
                                        <input style="width: 32%;" name="email" placeholder="email" value="{{ $email }}" class="form-control" type="text">
                                        <br>

                                        <label for="Password">Wachtwoord</label>
                                        <input style="width: 32%;" name="password" type="text" placeholder="wachtwoord" class="form-control">
                                        <br>

                                        <label for="test">Profiel foto</label>
                                        {!! Form::file('avatar') !!}
                                        <br>

                                        <button class="btn btn-success" type="submit">
                                            Wijzigen
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>{{-- END tab-content --}}

                </div>{{-- END col-9 --}}
            </div>
            {{-- end row --}}
        </div>

        {{-- Import footer component --}}
        @include('partials.footer')
    </body>
</html>
