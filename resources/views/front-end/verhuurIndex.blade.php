@extends('partials.verhuur')

@section('breadcrumb')
    <ol class="breadcrumb border">
        <li><a href="{{ URL::to('/') }}"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">Verhuur</li>
    </ol>
@endsection

@section('content')
    <div style="margin-top: -20px;" class="page-header">
        <h2 style="margin-bottom: -5px;">Verhuur info</h2>
    </div>

    <p>
        Onze Lokalen zijn het hele jaar te huur voor verenigingen.<br>
        Of je een kampplaats in een mooie, avontuurlijke omgeving met speelterrein voor kinderen;<br>
        een overnachtings plaats zoekt, of ...! We zijn rustig gelegen nabij het stadspark van Turnhout.
    </p>

    <!-- Photo's -->
    <div class="row">
        <div class="col-md-6">
            <img class="img-rounded img-thumbnail" style="width: 400px; height: 200px;" src="/assets/files/1.jpg" alt="">
        </div>

        <div class="col-md-6">
            <img class="img-rounded img-thumbnail" style="width: 400px; height: 200px;" src="/assets/files/2.jpg" alt="">
        </div>
    </div>
    <!-- /// -->

    <p style="margin-top: 7px;">
        Onze lokalen Bestaan uit 2 Blokken. Waarin 1 grote zaal en 5 lokalen en sanitaire blok gevestigd zijn. De grote zaal is<br>
        Polyvalente. Verder is er ook nog een keuken. Deze keuken is voorzien 2 gasfornuizen, friet ketel ,keuken eiland, enz...
    </p>

    <!-- Photo's -->
    <div class="row">
        <div class="col-md-6">
            <img class="img-rounded img-thumbnail" style="width: 400px; height: 200px;" src="/assets/files/3.jpg" alt="">
        </div>

        <div class="col-md-6">
            <img class="img-rounded img-thumbnail" style="width: 400px; height: 200px;" src="/assets/files/4.jpg" alt="">
        </div>
    </div>
    <!-- /// -->

    <p style="margin-top: 7px;">
        In alle gebouwen is er verwarming aanwezig. Aan de gebouwen grenst er zich een groot grasveld, bos, vuurplaats<br>
        + u bevindt zich op wandel afstand van het stadspark. U hoeft ook echter 2 km te rijden voor zich u aan een<br>
        supermarkt bevind.
    </p>
@stop