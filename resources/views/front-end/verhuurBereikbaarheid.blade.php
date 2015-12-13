@extends('partials.verhuur')

@section('breadcrumb')
    <ol class="breadcrumb border">
        <li><a href="{{ URL::to('/') }}"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">Verhuur bereikbaarheid</li>
    </ol>
@stop

@section('content')
    <div style="margin-top: -20px;" class="page-header">
        <h2 style="margin-bottom: -5px;">Verhuur bereikbaarheid</h2>
    </div>

    <h4>Openbaar vervoer:</h4>

    <p>
        U kunt de trein of bus naar turnhout nemen. En vervolgens kunt met de bus verder naar de scoutsdomeinen. (Sint-Jorislaan 11).
        De bus die u kunt nemen heeft de nr 2. vervolgens stapt u af aan in de rozenlaan. En vanaf daar is het nog slechts 500 meter wandelen.
    </p>

    <h4>Eigen vervoer:</h4>

    <p>
        - Neem de E34 afslag 24 Turnhout-centrum. <br>
        - Neem vervolgens de N19 richting Steenweg op Zevendonk.v <br>
        - Sla vervolgens Steenweg op Zevendonk in. <br>
        - Sla vervolgens de Sint-Jorislaan in <br/>

    </p>
@stop
