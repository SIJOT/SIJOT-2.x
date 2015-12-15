@extends('partials.verhuur')

@section('breadcrumb')
    <ol class="breadcrumb border">
        <li><a href="{{ URL::to('/') }}"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">Verhuur Aanvraag</li>
    </ol>
@stop

@section('content')
    <div style="margin-top: -20px;" class="page-header">
        <h2 style="margin-bottom: -5px;">Verhuur aanvraag</h2>
    </div>

    <p><span class="octicon octicon-info"></span> Het laatste weekend van een maand verhuren we niet.</p>

    <form method="POST" action="{{ URL::to('/rental/insert') }}">
        {{-- CSRF token --}}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <label for="Start">Start datum:</label>
        <input style="width: 35%;" name="StartDatum" class="form-control" id="Start" placeholder="bv. 00/00/0000">
        <br>

        <label for="Eind">Eind datum:</label>
        <input style="width: 35%;" name="EindDatum" class="form-control" id="Eind" placeholder="bv. 00/00/0000">
        <br>

        <label for="Groep">Groep:</label>
        <input style="width: 35%;" name="Groep" class="form-control" id="Groep" placeholder="Groep">
        <br>

        <label for="Email"> E-mail </label>
        <input style="width: 35%;" class="form-control" name="Email" id="Email" placeholder="Voorbeeld@domein.be">
        <br>

        <button class="btn btn-success" type="submit"> Aanvragen </button>
        <button class="btn btn-danger" type="reset"> Reset </button>

    </form>
@stop
