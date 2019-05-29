<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TEST API</title>
</head>

<?php
include '../bd.php';
?>

<style>
    .container {
        max-width: 1040px;
        margin: auto;
        padding: 40px;
        text-align: left;
    }
</style>

<body>

<div class="container">

    <h1 style="text-align: center">API Deezer Album</h1>

    <form action="album.php" method="get" style="text-align: center">
        <input type="text" name="rech">
        <button>go !</button>
    </form>

    <hr>

    <?php
    if (isset($_GET['rech'])) {
        $json_album = file_get_contents("https://api.deezer.com/search/album?q=" . $_GET['rech']);
        $parsed_json = json_decode($json_album);

        for ($i = 0; $i < count($parsed_json->{'data'}); $i++) {
            echo $parsed_json->{'data'}[$i]->{'artist'}->{'id'} . " - ";
            echo $parsed_json->{'data'}[$i]->{'title'} . "<br>";
        }



    }
    ?>


    <hr>
    <?php
    var_dump($parsed_json);
    ?>


</div>

</body>

</html>