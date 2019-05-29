<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>MUSIC MAP</title>

    <link rel="stylesheet" href="map/jquery-jvectormap-2.0.3.css" type="text/css"/>
    <script src="jquery.js"></script>
</head>

<body>

<?php include 'bar2.php';
include 'bd.php';
include 'fonction_php.php';


$bdd = getBD();

if (isset($_GET['c'])) {
    $musiques = musique_découvrir($bdd, $_GET['c']);
}
?>


<div class="container">
    <form action="découvrir.php" method="get">
        <input type="hidden" name="c" value="0">
        <input style="padding: 10px; margin: 10px" type="submit" value="Top du moment">
    </form>

    <form action="découvrir.php" method="get">
        <input type="hidden" name="c" value="3">
        <input style="padding: 10px; margin: 10px" type="submit" value="Au hazard">
    </form>

    <form action="découvrir.php" method="get">
        <input type="hidden" name="c" value="1">
        <input style="padding: 10px; margin: 10px" type="submit" value="Surprenez-moi">
    </form>


    <audio autoplay="autoplay" controls="controls" style="width: 100%; padding-top:100px">
        <source src="<?php echo $musiques['preview'] ?>" type="audio/mpeg">
    </audio>

    <div class="container" style="text-align: center">
        <?php
        if (isset($_GET['c'])) {
            echo '<h3>';
            echo "<a href='artist.php?idartist=" . $musiques['idartiste'] . "'>";
            echo $musiques['titre'] . ' - ' . $musiques['nomartiste'];
            echo "</a>";
            echo '</h3>';
        }
        ?>
    </div>
</div>
</body>

</html>