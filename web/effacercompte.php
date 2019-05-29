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
    echo "<meta http-equiv='refresh' content='0;url=index.php' />";
    ?>
</head>

<body>

<?php include 'bar2.php'; ?>
<?php include 'bd.php'; ?>

<?php
session_start();
$bdd = getBD();
$rep = $bdd->query("DELETE FROM CLIENT WHERE CLIENT.mailclient = '" . $_SESSION['client'][4] . "'");
session_destroy();
?>


</body>

</html>