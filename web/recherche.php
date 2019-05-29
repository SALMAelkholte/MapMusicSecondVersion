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
include 'bar2.php';
include 'bd.php';
include 'fonction_php.php';
?>

<div class="container">
    <?php
    if (isset($_GET['r'])) {

        $limit = 5;
        $_GET['r'] = str_replace(' ', '_', $_GET['r']);
        $json_deezer = file_get_contents("https://api.deezer.com/search/artist/?q=" . $_GET['r'] . "&index=0&limit=" . $limit . "&output=json");
        $parsed_json = json_decode($json_deezer);


        for ($i = 0; $i < count($parsed_json->{'data'}); $i++) {

            $name_artist = $parsed_json->{'data'}[$i]->{'name'};
            $id_artist = intval($parsed_json->{'data'}[$i]->{'id'});
            $img_artist = $parsed_json->{'data'}[$i]->{'picture_medium'};


            ?>
            <a href="artist.php<?php echo '?idartist=' . $id_artist ?>">
                <div class="recherche">
                    <div style="text-align: center;">
                        <h2><?php echo $name_artist; ?></h2>
                        <p><?php echo "ID : " . $id_artist; ?></p>
                    </div>
                    <div style="text-align: center">
                        <img src="<?php echo $img_artist; ?>" alt="">
                    </div>
                </div>
            </a>

            <hr>

            <?php
        }
    }
    ?>
</div>

</body>

</html>