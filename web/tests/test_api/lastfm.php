<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TEST API</title>
</head>

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

    <h1 style="text-align: center">API LastFM</h1>

    <form action="lastfm.php" method="get" style="text-align: center">
        <input type="text" name="rech">
        <button>go !</button>
    </form>

    <?php
    if (isset($_GET['rech'])) {

    #$_GET['rech'] = str_replace(' ', '_', $_GET['rech']); #pas besoin pour lastfm
    $json = file_get_contents("http://ws.audioscrobbler.com/2.0?method=artist.getinfo&artist=" . $_GET['rech'] . "&api_key=42532cda65558a05d69251a386717a0f&format=json");
    $parsed_json = json_decode($json);
    $bio_artist = $parsed_json->{'artist'}->{'bio'}->{'summary'};
    $similar_artist = $parsed_json->{'artist'}->{'similar'}->{'artist'};

    echo '<h3>Bio :</h3>' . $bio_artist;
    $nbSim = count($similar_artist);

    echo '<h3>Similaire : </h3>';
    for ($i = 0; $i < $nbSim; $i++) {
        echo $similar_artist[$i]->{'name'}.'<br>';
    }

    echo '<hr>';

    ?>


</div>

<?php
var_dump(json_decode($json));
}
?>


</body>

</html>