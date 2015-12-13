<!DOCTYPE html>
<html>
<head>
    {{-- Include header component --}}
    @include('partials.header')
</head>
<body class="background">
{{-- Include navbar component --}}
@include('partials.navbar')

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
            @yield('breadcrumb')
        </div>

        <div class="col-sm-3">
            <div class="panel panel-default border">
                <div class="panel-heading">
                    Menu:
                </div>

                <div class="list-group">
                    <a class="list-group-item" href="{{ Url::to('/verhuur') }}">
                        <span class="fa fa-info-circle"></span>
                        Info
                    </a>
                    <a class="list-group-item" href="{{ Url::to('/verhuur/bereikbaarheid') }}">
                        <span class="fa fa-asterisk"></span>
                        Bereikbaarheid
                    </a>
                    <a class="list-group-item" href="{{ Url::to('/verhuur/kalender') }}">
                        <span class="fa fa-calendar"></span>
                        Verhuur Kalender
                    </a>
                    <a class="list-group-item" href="{{ Url::to('/verhuur/aanvragen') }}">
                        <span class="fa fa-plus"></span>
                        Verhuur Aanvragen
                    </a>
                    <a class="list-group-item" href="mailto:verhuur@st-joris-turnhout.be">
                        <span class="fa fa-envelope"></span>
                        Contact
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="panel panel-default border">
                <div class="panel-body">

                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Include footer component --}}
@include('partials.footer')
</body>
</html>
