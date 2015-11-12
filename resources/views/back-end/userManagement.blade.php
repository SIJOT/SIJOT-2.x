<!DOCTYPE html>
<html lang="nl">
    <head>
        {{-- Include the header component --}}
        @include('partials.header')

                <!-- TODO: set this to external css file. -->
        <style>
            .top-padding-10 {
                padding-top: 10px;
            }
        </style>
    </head>
    <body>
        {{-- Include navbar component --}}
        @include('partials.navbar')

        <div class="container">
            <div class="row">
                <div class="wol-xs-12 col-sm-12 col-md-12 col-lg-12">
                    {{-- Tab title's --}}
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#users" aria-controls="users" role="tab" data-toggle="tab">
                                Login's
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#registration" aria-controles="registration" role="tab" data-toggle="tab">
                                Nieuwe login
                            </a>
                        </li>
                    </ul>
                    {{-- End tab titles --}}

                    {{-- Tab content --}}
                    <div class="tab-content">
                        {{-- Begin user registration --}}
                        <div role="tabpanel" class="tab-pane fade in" id="registration">
                            <div class="row top-padding-10">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    {{-- Session and validator block --}}
                                    <!-- TODO: Set flash session method in it with or (||) method -->
                                    @if(! empty($errors) && count($errors->all()) > 0)
                                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                            <div class="alert alert-danger">
                                                <h4>Oops! Foutieve invoer!</h4>

                                                <ul>
                                                    @foreach($errors->all() as $error)
                                                        <li> {{ $error }} </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- Session and validator block --}}
                                    <form action="{{ Url::to('/backend/acl/register') }}" method="POST">
                                        {{-- CSRF validation --}}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <label for="Name">Naam:</label>
                                        <input id="name" type="text" class="form-control" name="name" placeholder="Gebruikersnaam">
                                        <br />

                                        <label for="Email">Email adres:</label>
                                        <input id="Email" type="text" class="form-control" name="email" placeholder="Email adres">
                                        <br />

                                        <button type="submit" class="btn btn-danger">
                                            Aanmaken
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- End user registration --}}

                        {{-- Begin user table --}}
                        <div role="tabpanel" class="tab-pane fade in active" id="users">
                            <div class="row top-padding-10">
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                    <!-- TODO: Needs Laravel datatables implementation -->
                                    <table class="table table-condensed table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Naam:</th>
                                                <th>Status:</th>
                                                <th>Groep:</th>
                                                <th>Email:</th>
                                                <th></th> {{-- Functons --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($gebruikers as $user)
                                                <tr>
                                                    <td> <code> #{{  $user->id }} </code> </td>
                                                    <td> {{ $user->name }} </td>

                                                    <td>
                                                        @if($user->blocked == 0)
                                                            <span class="label label-success">Actief</span>
                                                        @elseif($user->blocked == 1)
                                                            <span class="label label-danger">Geblokkeerd</span>
                                                        @endif
                                                    </td>

                                                    <td> <i> Undifined </i> </td>
                                                    <td> {{ $user->email  }} </td>

                                                    {{-- BTN group for the handlings--}}
                                                    <td>
                                                        <div class="btn-group">

                                                            <a href="{{ Url::to('/backend/acl/delete/' . $user->id) }}" class="btn btn-xs btn-danger">
                                                                <span class=""></span> Verwijderen
                                                            </a>

                                                            @if($user->blocked == 0)
                                                            <a class="btn btn-xs btn-warning" href="{{URL::to('/backend/acl/block/'. $user->id) }}">
                                                                <span class="fa fa-lock"></span>
                                                                Blokkeren
                                                            </a>
                                                            @endif

                                                            @if($user->blocked == 1)
                                                                <a class="btn btn-xs btn-warning" href="{{URL::to('/backend/acl/unblock/'. $user->id) }}">
                                                                <span class=""></span> Deblokkeren
                                                            </a>
                                                            @endif

                                                            <a href="{{ URL::to('/backend/acl/profile/'. $user->id) }}" class="btn btn-xs btn-success">
                                                               <span class=""></span> Bekijk
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- Pagination method --}}
                                    <?php echo $gebruikers->render(); ?>
                                    {{-- End pagination method --}}
                                </div>
                            </div>
                        </div>
                        {{-- end user table --}}
                    </div>
                    {{-- end tab content --}}
                </div>
            </div>
        </div>

        {{-- @include the footer component --}}
        @include('partials.footer')
    </body>
</html>