<!DOCTYPE html>
<html lang="nl">
    <head>
        {{-- Load the header data --}}
        @include('partials.header')
    </head>
    <body class="background">
    {{-- Load the navbar --}}
    @include('partials.navbar')

    {{-- The content --}}
    <div class="container">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 col-sm-12">
                <ol class="breadcrumb border">
                    <li><a href="{{URL::to('/')}}"><span class="glyphicon glyphicon-home"></span></a></li>
                    <li><a href="{{URL::to('/')}}/takken">Takken</a></li>
                    <li class="active">
                        @foreach($Beschrijving as $BC)
                            {{ $BC->Title }}
                        @endforeach
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3 col-lg-3">
                <div class="panel panel-default border">
                    <div class="panel-heading">
                        Wat doen we?
                    </div>

                    <div class="panel-body">
                        @if(count($Activiteiten) == 0)
                            <span class="text-muted">Geen activiteiten beschikbaar.</span>
                        @else
                            <ul class="list-unstyled">
                                @foreach($Activiteiten as $Activiteit)
                                <li>
                                    <b>{{ $Activiteit->Datum }}:</b>
                                    <a title="{{ $Activiteit->Naam }}" href="{{URL::to('/')}}">Activiteit</a>
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-sm-9 col-md-9 col-lg-9 col-lg-9">
                <div class="panel panel-default border">
                    <div class="panel-body">
                        @foreach($Beschrijving as $Tak)

                        <div style="margin-top: -20px;" class="page-header">
                            <h2 style="margin-bottom: -5px;">
                                {{ $Tak->Title }} <small> {{ $Tak->Sub_title }} </small>
                            </h2>
                        </div>

                            {{-- Description --}}
                            @if (! empty($Tak->Beschrijving))
                                {{$Tak->Beschrijving}}
                            @else
                                <div class="alert alert-warning">
                                    <h4> Oh :( </h4>
                                    <p>
                                        Wij konden helaas geen tak beschrijving vinden.
                                        Mogelijk heeft de administrator er geen in gegeven.
                                    </p>

                                    <p>
                                        Denkt u dat dit een fout is? Dan kont u ons bereiken op
                                        <a href="mailto:contact@st-joris-turnhout.be">
                                            Contact@st-joris-turnhout.be.
                                        </a>
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Load the JavaScript includes. --}}
    @include('partials.footer')
    </body>
</html>
