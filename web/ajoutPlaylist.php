<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>MUSIC MAP</title>
    <meta http-equiv="refresh" content="1;URL=index.php">
</head>

<?php
include 'bd.php';
$bdd = getBD();
include 'fonction_php.php';
?>

<body>

<div class="container" style="text-align: center">

    <?php
    $ok = ajout_playlist($bdd, $_GET['idmusique'], $_GET['idclient']);
    if ($ok) {
        echo "Ajoutée à votre playlist !";
    }
    ?>

</div>

</body>

</html>