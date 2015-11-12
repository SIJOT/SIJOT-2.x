<!DOCTYPE html>
<html lang="nl">
    <head>
    </head>
    <body>
        <p> Geachte, </p>

        <p>
            Uw bent successvol geregistreerd op de website van
            <a href="http://www.st-joris-turnhout.be">Scouts en Gidsen - Sint-Joris Turnhout</a>
            geregistreerd hier onder kunt u alle gegevens nog eens vinden.
        </p>

        <p>
            Wij raden u aan na de eerste login het wachtwoord te wijzigen.
        </p>

        <p>
            <table>
                <tr>
                    <td><strong>Naam:</strong></td>
                    <td>{{ $users->name }}</td>
                </tr>
                <tr>
                    <td><strong>Email:</strong></td>
                    <td>{{ $users->email }}</td>
                </tr>
                <tr>
                    <td><strong>Wachtwoord:</strong></td>
                    <td>sijot</td>
                </tr>
            </table>
        </p>

        <p>
            Met vriendelijke groet.
        </p>

    </body>
</html>