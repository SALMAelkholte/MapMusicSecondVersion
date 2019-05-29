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

</head>

<?php
include 'bd.php';
include 'fonction_php.php';

$bdd = getBD();

if (isset($_GET['c'])) {
    $musiques = musique_pays($bdd, $_GET['c']);
}
?>



<?php include 'bar2.php'; ?>
<div class="container">

    <div class="lecteur" style="">

        <div>
            <?php
            if (isset($_GET['idartiste'])) {
            $album = album_alea($bdd, $_GET['idartiste']);
            ?>

            <h3 style="text-align: center"><?php echo $album['nomalbum'] ?></h3>
            <div style="max-width: 200px; margin: auto;">
                <img src="<?php echo $album['coveralbum'] ?>" alt="" style="width: 100%">
            </div>
        </div>

        <div>
            <?php
            $musique = musique_alea($bdd, $album['idalbum']);
            if ($musique) {
                echo "<h2 style='text-align: center'>" . $musique['titre'] . "</h2>";
                ?>
                <div>
                    <audio controls style="width: 100%; margin: auto">
                        <?php
                        echo "<source src='" . $musique['preview'] . "' type='audio/mpeg'>"
                        ?>
                    </audio>
                    <?php
                    if (isset($_SESSION['client'])) {
                        ?>
                        <form action="ajoutPlaylist.php" style="text-align: center">
                            <input type="hidden" value="<?php echo $musique['idmusique'] ?>" name="idmusique">
                            <input type="hidden" value="<?php echo $_SESSION['client'][4] ?>" name="idclient">
                            <input type="submit" value="Ajouter à ma playlist">
                        </form>
                        <?php
                    }
                    ?>
                </div>
                <?php
            } else {
                ajout_tracklist($bdd, $album['tracklist'], $album['idalbum'], $album['idartiste']);
                $musique = musique_alea($bdd, $album['idalbum']);
                echo "<h2 style='text-align: center'>" . $musique['titre'] . "</h2>";
                ?>
                <div>
                    <audio controls style="width: 100% ; margin: auto" autoplay="autoplay">
                        <?php
                        echo "<source src='" . $musique['preview'] . "' type='audio/mpeg'>"
                        ?>
                    </audio>
                    <?php
                    if (isset($_SESSION['client'])) {
                        ?>
                        <form action="ajoutPlaylist.php" style="text-align: center">
                            <input type="hidden" value="<?php echo $musique['idmusique'] ?>" name="idmusique">
                            <input type="hidden" value="<?php echo $_SESSION['client'][4] ?>" name="idclient">
                            <input type="submit" value="Ajouter à ma playlist">
                        </form>
                        <?php
                    }
                    ?>
                    <p style="text-align: center">La tracklist vient de s'ajouter</p>
                </div>
                <?php
            }
            }
            ?>


            <?php
            if (isset($_GET['c'])) {
            $artiste = artiste_pays($bdd, $_GET['c']);
            if ($artiste){

            $album = album_alea($bdd, $artiste['idartiste']);
            ?>

            <h3 style="text-align: center"><?php echo $album['nomalbum'] ?></h3>
            <div style="max-width: 200px; margin: auto;">
                <img src="<?php echo $album['coveralbum'] ?>" alt="" style="width: 100%">
            </div>
        </div>

        <div>
            <?php
            $musique = musique_alea($bdd, $album['idalbum']);
            if ($musique) {
                echo "<a href='artist.php?idartist=".$musique['idartiste']."'>";
                echo "<h2 style='text-align: center'>" . $musique['titre'] . " - " . $artiste['nomartiste'] . "</h2>";
                echo "</a>";
                ?>
                <div>
                    <audio controls style="width: 100%" autoplay="autoplay">
                        <?php
                        echo "<source src='" . $musique['preview'] . "' type='audio/mpeg'>"
                        ?>
                    </audio>
                    <?php
                    if (isset($_SESSION['client'])) {
                        ?>
                        <form action="ajoutPlaylist.php" style="text-align: center">
                            <input type="hidden" value="<?php echo $musique['idmusique'] ?>" name="idmusique">
                            <input type="hidden" value="<?php echo $_SESSION['client'][4] ?>" name="idclient">
                            <input type="submit" value="Ajouter à ma playlist">
                        </form>
                        <?php
                    }
                    ?>
                </div>
                <?php
            } else {
                ajout_tracklist($bdd, $album['tracklist'], $album['idalbum'], $album['idartiste']);
                $musique = musique_alea($bdd, $album['idalbum']);
                echo "<a href='artist.php?idartist=".$musique['idartiste']."'>";
                echo "<h2 style='text-align: center'>" . $musique['titre'] . " - " . $artiste['nomartiste'] . "</h2>";
                echo "</a>";
                ?>
                <div>
                    <audio controls style="width: 100%" autoplay="autoplay">
                        <?php
                        echo "<source src='" . $musique['preview'] . "' type='audio/mpeg'>"
                        ?>
                    </audio>
                    <?php
                    if (isset($_SESSION['client'])) {
                        ?>
                        <form action="ajoutPlaylist.php" style="text-align: center">
                            <input type="hidden" value="<?php echo $musique['idmusique'] ?>" name="idmusique">
                            <input type="hidden" value="<?php echo $_SESSION['client'][4] ?>" name="idclient">
                            <input type="submit" value="Ajouter à ma playlist">
                        </form>
                        <?php
                    }
                    ?>
                    <p style="text-align: center">La tracklist vient de s'ajouter</p>
                </div>
                <?php
            }
            } else {
                echo "<p style='text-align: center'>Il n'y a pas d'artiste dans notre base de données pour ce pays.</p>";
            }
            }
            ?>
        </div>
    </div>
    <hr>
</div>
<div>

    <script src="jquery.js"></script>
    <script src="map/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="map/jquery-jvectormap-world-merc.js"></script>
    <div class="container">
        <?php
        include 'map/map.php'
        ?>
    </div>
</div>

</body>

</html>