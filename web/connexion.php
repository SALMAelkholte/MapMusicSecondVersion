<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>MUSIC MAP</title>
</head>

<body>
<?php include 'bar2.php'; ?>
<?php include 'bd.php'; ?>

<div class="container">

    <p class="iden">Vous avez un compte ? Connectez vous :</p>
    <div class="identification">
        <form method="POST" action="connecter.php" autocomplete="off">
            <table style="border-spacing:20px">
                <tr>
                    <td>Adresse mail :</td>
                    <td><INPUT type="text" name="mail" value=""></td>
                </tr>
                <tr>
                    <td>Mot de passe :</td>
                    <td><INPUT type="password" name="mdp1" value=""></td>
                </tr>
            </table>
            <p style="text-align:center"><INPUT type="submit" value="Connexion"></p>
        </form>

    </div>
    <p style="text-align:center">Vous n'avez pas de compte ? <a href="inscription.php">Inscrivez vous !</a></p>
</div>

</body>

</html>