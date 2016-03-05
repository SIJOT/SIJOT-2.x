<!DOCTYPE html>
<html lang="nl">
<head>
    {{-- Load the header data --}}
    @include('partials.header')

    {{-- Costum stylesheet dedicated to this page only. --}}
    <link rel="stylesheet" href="{{ URL::to('/css/frontpage.css') }}" />
</head>
<body>
{{-- Load the navbar --}}
@include('partials.navbar')

<img style="margin-bottom: 60px; width: 100%; height: 400px;" src="/img/front.jpg">

<div class="container marketing">
    <div class="row">
        <div class="col-lg-4">
            <img class="img-thumbnail img-circle" src="/img/front-2.jpg" alt="Generic placeholder image" style="width: 140px; height: 140px;">
            <h2 class="font-heading">Ontbijt!</h2>
            <p>Elke laatste zondag  van de maand! Doe onze scouts een ontbijt. Een ontbijt waar u als u wilt aanwezig kunt zijn met uw kinderen. Dit vind plaats op de scouts gronden U zicht enkel in te schrijven. Hier voor kunt u voorlopig terecht bij Leo Willems.  </p>
            <p><a class="btn btn-default" href="/index.php/Inschrijvingen/Ontbijt_beschrijving">Inschrijven »</a></p>
        </div>
        <div class="col-lg-4">
            <img class="img-thumbnail img-circle" src="/img/front-1.jpg" alt="Generic placeholder image" style="width: 140px; height: 140px;">
            <h2 class="font-heading">Takken</h2>
            <p>Benieuwd in welke tak je zit? Of wil je gewoon je tak-pagina bezoeken? Wel u kunt hem in een paar klikken bezoeken. Want elke tak heeft zijn eigen pagina. Das straf he! Nee helemaal niet! U vind hier ook alle beschrijvingen van takken. </p>
            <p><a class="btn btn-default" href="{{ Url::to('/takken') }}">Lees meer »</a></p>
        </div>
        <div class="col-lg-4">
            <img class="img-thumbnail img-circle" src="/img/front-3.jpg" alt="Generic placeholder image" style="width: 140px; height: 140px;">
            <h2 class="font-heading">Verhuur</h2>
            <p>Bent u jeugdbeweging of organisatie die een kamplaats of overnachtingsplaats zoekt? Dan bent u hier aan het juiste adres wij stellen namelijk onze lokalen te huur aan jullie. Indien u geintresseerd bent kunt hier op onze verhuur pagina meer vinden. </p>
            <p><a class="btn btn-default" href="{{ Url::to('/verhuur') }}">Lees meer »</a></p>
        </div>
    </div>
</div>
<hr>
<footer>
    <p>© 2015 - Sint-Joris Turnhout</p>
</footer>
</div>

{{-- Load the JavaScript includes. --}}
@include('partials.footer')
</body>
</html>
