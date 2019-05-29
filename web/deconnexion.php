<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>MUSIC MAP</title>
    <?php
    echo "<meta http-equiv='refresh' content='2;url=index.php' />";
    ?>
</head>

<body>

<?php include 'bar2.php';
session_destroy();

echo "<h1 style='padding: 50px'>Revenez vite ".$_SESSION['client'][2]."..</h1>"; ?>
<div class='gif'><img src='assets/img/gif/sad2.gif'></div>

</body>

</html>