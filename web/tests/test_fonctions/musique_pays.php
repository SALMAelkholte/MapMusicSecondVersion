<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../style.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>MUSIC MAP</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css"
          integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9"
          crossorigin="anonymous">
    <link rel="stylesheet" href="lecteur/css/audioPlayer.css">

</head>

<body>

<?php
session_start();
include '../../bd.php';
include '../../fonction_php.php';
$bdd = getBD();
?>

<div class="container">
    <h1>Test Musique !</h1>
    <hr>
    <div style="max-width: 300px; margin: auto;">
        <img src="../../assets/img/gif/bongo.gif" alt="" style="width: 100%">
    </div>

    <form action="musique_pays.php" method="get">
        <p style="text-align: center">Code Pays :</p>
        <table style="width: 250px; margin: auto;">
            <tr>
                <td><input type="text" name="c" value="MX"></td>
                <td><input type="submit" value="Let's go !"></td>
            </tr>
        </table>
    </form>

    <hr>

    <?php
    if (isset($_GET['c'])) {
        $musiques = musique_pays($bdd, $_GET['c']);
        ?>

        <div style="text-align: center">

            <div>
                <?php
                echo "<h3>" . $musiques['nomartiste'] . " - " . $musiques['titre'] . "</h3>";
                echo "<br> ID Musique : " . $musiques['idmusique'];
                echo "<br> Lien preview : " . $musiques['preview'];
                ?>

            </div>
        </div>

        <?php
    }
    ?>

    <?php
    include 'lecteur/lecteur.php'
    ?>

</div>

</body>

</html>