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

<?php
include 'bar2.php'; ?>

<div style="max-width: 600px; margin: auto; margin-top: 50px;">
    <form action="recherche.php" method="get">
        <input name="r" type="text" placeholder="Rechercher" style="width: 80%"/>
        <input type="submit" value="Go !"/>
    </form>
</div>

</body>

</html>