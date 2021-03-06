<!DOCTYPE html>
<html lang="nl">
<head>
    <title> Verhuur notification </title>

</head>
<body>
<h4> Bevestiging aanvraag. </h4>

<p>
    Bedankt voor uw intresse in ons. Met deze mail heeft u een bevestiging dat uw aanvraag goed is doorgekomen.
    Hier zijn alle gegevens nog is. Indien u deze verhuring niet hebt aangevraagd of de gegevens foutief zijn.
    Kunt u zich wenden tot <a href="mailto:Verhuur@st-joris-turnhout.be">Verhuur@st-joris-turnhout.be</a>
</p>

<table class="table table-condensed table-bordered">
    <tbody>
    <tr>
        <td> <strong> Start Datum: </strong> </td>
        <td> <?php echo $data->StartDatum; ?>
    </tr>
    <tr>
        <td> <strong> Eind Datum: </strong> </td>
        <td> <?php echo $data->EindDatum; ?>
    </tr>
    <tr>
        <td> <strong> Groep: </strong> </td>
        <td> <?php echo $data->Groep; ?>
    </tr>
    <tr>
        <td> <strong> Email: </strong> </td>
        <td> <?php echo $data->Email; ?>
    </tr>
    </tbody>
</table>

<hr>
<p class="small text-muted">
    Deze mail notificatie is afkomstig van <a href="http://www.st-joris-turnhout.be">www.st-joris-turnhout.be</a> <br>
</p>
</body>
</html>
