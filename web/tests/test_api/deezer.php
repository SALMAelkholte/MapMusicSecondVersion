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
include 'bd.php';
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

    <h1 style="text-align: center">API Deezer</h1>

    <form action="deezer.php" method="get" style="text-align: center">
        <input type="text" name="rech">
        <button>go !</button>
    </form>

    <?php
    if (isset($_GET['rech'])) {

    $_GET['rech'] = str_replace(' ', '_', $_GET['rech']);
    $json = file_get_contents("https://api.deezer.com/search/artist/?q=" . $_GET['rech'] . "&index=0&limit=5&output=json");
    $parsed_json = json_decode($json);
    $name_artist = $parsed_json->{'data'}[0]->{'name'};
    $id_artist = $parsed_json->{'data'}[0]->{'id'};
    $img_artist = $parsed_json->{'data'}[0]->{'picture_medium'};

    echo '<hr>';
    echo '<p>' . $name_artist . '</p>';
    echo '<p>ID artiste : ' . $id_artist . '</p>';
    echo "<img src='" . $img_artist . "' alt=''>";

    echo '<hr>';

    ?>


</div>

<?php
var_dump(json_decode($json));
}
?>


</body>

</html>