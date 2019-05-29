<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>MUSIC MAP</title>
    <?php
    echo "<meta http-equiv='refresh' content='3;url=index.php' />";
    ?>
</head>

<body>

<?php include 'bar2.php'; ?>
<?php include 'bd.php'; ?>

<?php
$bdd = getBD();
$rep = $bdd->query("SELECT * FROM CLIENT WHERE mailclient = '" . $_POST['mail'] . "' AND mdpclient = '" . $_POST['mdp1'] . "'");
$repco = $rep->fetch();
if ($repco == "") {
    echo "<meta http-equiv='refresh' content='2;url=connexion.php' />";
} else {
    $_SESSION['client'] = array($repco['nomclient'], $repco['prenomclient'], $repco['pseudo'], $repco['mdpclient'], $repco['mailclient'], $repco['nb_contrib']);
    echo "<meta http-equiv='refresh' content='2;url=index.php' /><div>
<h1 style=\"padding: 50px\">Heureux de vous revoir " . $_SESSION['client'][2] . " !</h1>
<div class='gif'><img src='assets/img/gif/content.gif'></div>
</div>";
}
$rep->closeCursor();
?>

</body>

</html>