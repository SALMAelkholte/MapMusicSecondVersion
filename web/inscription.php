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

    <p class="iden"> Créez votre compte, et un nouveau monde mélodieux s'offrira à vous !</p>
    <form method="POST" action="enregistrement.php" autocomplete="off">
        <table class="table">
            <tr>
                <td>Nom :</td>
                <td><INPUT type="text" name="n" value="<?php
                    if (isset($_GET['n'])){
                        echo $_GET['n'];}
                    else{echo"";}
                        ?>"></td>
            </tr>
            <tr>
                <td>Prénom :</td>
                <td><INPUT type="text" name="p" value="<?php
                    if (isset($_GET['p'])){
                        echo $_GET['p'];}
                    else{echo"";}
                    ?>"></td>
            </tr>
            <tr>
                <td>Pseudo :</td>
                <td><INPUT type="text" name="ps" value="<?php
                    if (isset($_GET['ps'])){
                        echo $_GET['ps'];}
                    else{echo"";}
                    ?>"></td>
            </tr>
            <tr>
                <td>Adresse-mail :</td>
                <td><INPUT type="text" name="mail" value="<?php
                    if (isset($_GET['mail'])){
                        echo $_GET['mail'];}
                    else{echo"";}
                    ?>"></td>
            </tr>
            <tr>
                <td>Mot de passe :</td>
                <td><INPUT type="password" name="mdp1" value=""></td>
            </tr>
            <tr>
                <td>Confirmation du mot de passe :</td>
                <td><INPUT type="password" name="mdp2" value=""></td>
            </tr>
        </table>
        <p style="text-align:center"><INPUT type="submit" value="Inscription"></p>
    </form>

</div>
</body>

</html>