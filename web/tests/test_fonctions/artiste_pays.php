<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../style.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>MUSIC MAP</title>
</head>

<body>

<?php
session_start();
include '../../bd.php';
include '../../fonction_php.php';
$bdd = getBD();
?>

<div class="container">
    <h1>Test Artistes - Pays !</h1>
    <hr>
    <div style="max-width: 300px; margin: auto;">
        <img src="../../assets/img/gif/bongo.gif" alt="" style="width: 100%">
    </div>

    <form action="artiste_pays.php" method="get">
        <p style="text-align: center">Id Artiste, à ajouter à la BD :</p>
        <table style="width: 250px; margin: auto;">
            <tr>
                <td><input type="text" name="id" value="3771"></td>
                <td><input type="submit" value="Let's go !"></td>
            </tr>
        </table>
    </form>

    <hr>

    <?php
    if (isset($_GET['id'])) {

        if (check_artiste($bdd, $_GET['id'])) {
            echo 'Il est la ! :)';
            #echo "<br>Pays : " . pays_artiste($bdd, $_GET['id'])[0] . pays_artiste($bdd, $_GET['id'])[1];
            echo pays_artiste($bdd, $_GET['id']);

        } else {
            echo 'Il n\'existe pas ... :(';
        }

    }
    ?>

</div>

</body>

</html>