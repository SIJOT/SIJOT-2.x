<!DOCTYPE html>
<html lang="nl">
    <head>
        {{-- Include the navbar component --}}
        @include('partials.header')
    </head>
    <body class="background">
        {{-- Include the navbar component --}}
        @include('partials.navbar')

        <div class="container">
            {{-- Begin breadcrumb --}}
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
                    <ol class="breadcrumb border">
                        <li>
                            <a href="{{ URL::to('/') }}">
                                <span class="glyphicon glyphicon-home"></span>
                            </a>
                        </li>
                        <li class="active">Takken</li>
                    </ol>
                </div>
            </div>
            {{-- end breadcrumb --}}

            {{-- global content --}}
            <div class="row">
                {{-- Sidebar --}}
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="border panel panel-default">
                        <div class="panel-heading">
                            Takken
                        </div>

                        <div class="list-group">
                            @foreach($takken as $tak)
                                <a class="list-group-item" href="/takken/{{ $tak->URI_fragment }}">
                                    {{ $tak->Title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- End sidebar --}}

                {{-- groups overview --}}
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="border panel panel-default">
                        <div class="panel-body">
                            <div style="margin-top: -20px;" class="page-header">
                                <h2 style="margin-bottom: -5px;">Takken:</h2>
                            </div>

                            @foreach($kapoenen as $Kapoen)
                                <div class="well well-sm color-kapoenen">
                                    <div class="media">
                                        <a class="pull-left" href="">
                                            <img style="width: 75px; height: 75px;" class="color-white img-responsive img-rounded media-object" src="{{ URL::to('/img/kapoenen.png')  }}" alt="{{ $Kapoen->Title }}">
                                        </a>
                                        <div class="media-body color-white">
                                            <h4 class="font-title media-heading">
                                                {{  $Kapoen->Title }}
                                                <small> {{  $Kapoen->Sub_title }} </small>
                                            </h4>

                                            {{-- Description --}}
                                            @if(! empty($Kapoen->Beschrijving))
                                                {{ $Kapoen->Beschrijving  }}
                                            @else
                                                <span class="text text-muted">
                                                    <i>
                                                        Er is geen beschrijving gevonden voor deze tak.
                                                    </i>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @foreach($welpen as $welp)
                                <div class="well well-sm color-welpen">
                                    <div class="media">
                                        <a class="pull-left" href="">
                                            <img style="width: 75px; height: 75px;" class="color-white img-responsive img-rounded media-object" src="{{ URL::to('/img/welpen.png')  }}" alt="{{ $welp->Title }}">
                                        </a>
                                        <div class="media-body color-white">
                                            <h4 class="font-title media-heading">
                                                {{  $welp->Title }}
                                                <small> {{  $welp->Sub_title }} </small>
                                            </h4>

                                            {{-- Description --}}
                                            @if(! empty($welp->Beschrijving))
                                                {{ $welp->Beschrijving  }}
                                            @else
                                                <span class="text-muted">
                                                    <i>
                                                        Er is geen beschrijving gevonden voor deze tak.
                                                    </i>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @foreach($jongGivers as $JGiver)
                                <div class="well well-sm color-jonggivers">
                                    <div class="media">
                                        <a class="pull-left" href="">
                                            {{-- TODO: Need to change the image into a file path. --}}
                                            <img style="width: 75px; height: 75px;" class="color-white img-responsive img-rounded media-object" src="https://raw.githubusercontent.com/Tjoosten/SIJOT-2/master/public/assets/files/jong-givers.png" alt="{{ $welp->Title }}">
                                        </a>
                                        <div class="media-body color-white">
                                            <h4 class="font-title media-heading">
                                                {{  $JGiver->Title }}
                                                <small> {{  $JGiver->Sub_title }} </small>
                                            </h4>

                                            {{-- Description --}}
                                            @if(! empty($JGiver->Beschrijving))
                                                {{ $JGiver->Beschrijving  }}
                                            @else
                                                <span class="text-muted">
                                                    <i>
                                                        Er is geen beschrijving gevonden voor deze tak.
                                                    </i>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                {{-- end group overview --}}
            </div>
            {{-- end global content --}}
        </div>

        {{-- Include the footer component --}}
        @include('partials.footer')
    </body>
</html>