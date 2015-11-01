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
                        <img title="profile image" class="img-circle img-responsive" src="http://www.gravatar.com/avatar/28fd20ccec6865e2d5f0e1f4446eb7bf?s=100">
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
                        <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
                        <div class="panel-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
                    </div>


                    <ul class="list-group">
                        <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
                        <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
                    </ul>

                    <div class="panel panel-default">
                        <div class="panel-heading">Social Media</div>
                        <div class="panel-body">
                            <i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
                        </div>
                    </div>

                </div>{{-- end col-3 --}}
                <div class="col-sm-9">

                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                        <li><a href="#messages" data-toggle="tab">Messages</a></li>
                        <li><a href="#permissions" data-toggle="tab">Gebruikersrechten</a></li>
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
                                                <th> Ja: / Nee:</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="" method="post">
                                                @foreach($permission as $right)
                                                    <tr>
                                                        <td>{{ $right->type }}</td>
                                                        <td>{{ $right->active }}</td>
                                                    </tr>
                                                @endforeach
                                            </form>
                                        </tbody>
                                    </table>

                                    <button type="submit" class="btn btn-success">
                                        Aanpassen
                                    </button>
                                </div>
                            </div>
                        </div>{{-- END tab-pane  --}}
                    </div>{{-- END tab-content --}}

                </div>{{-- END col-9 --}}
            </div>
            {{-- end row --}}
        </div>

        {{-- Import footer component --}}
        @include('partials.footer')
    </body>
</html>