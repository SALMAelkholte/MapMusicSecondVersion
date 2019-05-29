<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../style.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>MUSIC MAP</title>
</head>

<body>

<?php
session_start();
include '../../bd.php';
include '../../fonction_php.php';
$bdd = getBD();
?>

<div class="container">
    <h1>Test Musique !</h1>
    <hr>
    <div style="max-width: 300px; margin: auto;">
        <img src="../../assets/img/gif/bongo.gif" alt="" style="width: 100%">
    </div>

    <form action="random_music.php" method="get">
        <p style="text-align: center">ID Artiste :</p>
        <table style="width: 250px; margin: auto;">
            <tr>
                <td><input type="text" name="id" value="3771"></td>
                <td><input type="submit" value="Let's go !"></td>
            </tr>
        </table>
    </form>
    <form action="random_music.php" method="get">
        <p style="text-align: center">Code pays :</p>
        <table style="width: 250px; margin: auto;">
            <tr>
                <td><input type="text" name="c" value="SE"></td>
                <td><input type="submit" value="Let's go !"></td>
            </tr>
        </table>
    </form>

    <hr>

    <div class="recherche">

        <div>
            <?php
            if (isset($_GET['id'])) {
            $album = album_alea($bdd, $_GET['id']);
            ?>

            <h1><?php echo $album['nomalbum'] ?></h1>
            <div style="max-width: 300px; margin: auto;">
                <img src="<?php echo $album['coveralbum'] ?>" alt="" style="width: 100%">
                <p style="text-align: center">ID : <?php echo $album['idalbum'] ?></p>
            </div>
        </div>

        <div>
            <?php
            $musique = musique_alea($bdd, $album['idalbum']);
            if ($musique) {
                echo "<h2>" . $musique['titre'] . "</h2>";
                echo "<a href=" . $musique['preview'] . ">lien de la musique</a>";
                echo "<br> ISRC : " . $musique['isrc'];
                ?>
                <div>
                    <audio controls style="width: 100%">
                        <?php
                        echo "<source src='" . $musique['preview'] . "' type='audio/mpeg'>"
                        ?>
                    </audio>
                </div>
                <?php
            } else {
                echo "La tracklist vient de s'ajouter";
                ajout_tracklist($bdd, $album['tracklist'], $album['idalbum'], $album['idartiste']);
                $musique = musique_alea($bdd, $album['idalbum']);
                echo "<h2>" . $musique['titre'] . "</h2>";
                echo "<a href=" . $musique['preview'] . ">lien de la musique</a>";
                echo "<br> ISRC : " . $musique['isrc'];
                ?>
                <div>
                    <audio controls style="width: 100%">
                        <?php
                        echo "<source src='" . $musique['preview'] . "' type='audio/mpeg'>"
                        ?>
                    </audio>
                </div>
                <?php
            }
            }
            ?>

            <?php
            if (isset($_GET['id'])) {
            $album = album_alea($bdd, $_GET['id']);
            ?>

            <h1><?php echo $album['nomalbum'] ?></h1>
            <div style="max-width: 300px; margin: auto;">
                <img src="<?php echo $album['coveralbum'] ?>" alt="" style="width: 100%">
                <p style="text-align: center">ID : <?php echo $album['idalbum'] ?></p>
            </div>
        </div>

        <div>
            <?php
            $musique = musique_alea($bdd, $album['idalbum']);
            if ($musique) {
                echo "<h2>" . $musique['titre'] . "</h2>";
                echo "<a href=" . $musique['preview'] . ">lien de la musique</a>";
                echo "<br> ISRC : " . $musique['isrc'];
                ?>
                <div>
                    <audio controls style="width: 100%">
                        <?php
                        echo "<source src='" . $musique['preview'] . "' type='audio/mpeg'>"
                        ?>
                    </audio>
                </div>
                <?php
            } else {
                echo "La tracklist vient de s'ajouter";
                ajout_tracklist($bdd, $album['tracklist'], $album['idalbum'], $album['idartiste']);
                $musique = musique_alea($bdd, $album['idalbum']);
                echo "<h2>" . $musique['titre'] . "</h2>";
                echo "<a href=" . $musique['preview'] . ">lien de la musique</a>";
                echo "<br> ISRC : " . $musique['isrc'];
                ?>
                <div>
                    <audio controls style="width: 100%">
                        <?php
                        echo "<source src='" . $musique['preview'] . "' type='audio/mpeg'>"
                        ?>
                    </audio>
                </div>
                <?php
            }
            }
            ?>

            <?php
            if (isset($_GET['c'])) {
            $artiste = artiste_pays($bdd, $_GET['c']);
            print_r($artiste);
            $album = album_alea($bdd, $artiste['idartiste']);
            ?>

            <h1><?php echo $album['nomalbum'] ?></h1>
            <div style="max-width: 300px; margin: auto;">
                <img src="<?php echo $album['coveralbum'] ?>" alt="" style="width: 100%">
                <p style="text-align: center">ID : <?php echo $album['idalbum'] ?></p>
            </div>
        </div>

        <div>
            <?php
            $musique = musique_alea($bdd, $album['idalbum']);
            if ($musique) {
                echo "<h2>" . $musique['titre'] . "</h2>";
                echo "<a href=" . $musique['preview'] . ">lien de la musique</a>";
                echo "<br> ISRC : " . $musique['isrc'];
                ?>
                <div>
                    <audio controls style="width: 100%">
                        <?php
                        echo "<source src='" . $musique['preview'] . "' type='audio/mpeg'>"
                        ?>
                    </audio>
                </div>
                <?php
            } else {
                echo "La tracklist vient de s'ajouter";
                ajout_tracklist($bdd, $album['tracklist'], $album['idalbum'], $album['idartiste']);
                $musique = musique_alea($bdd, $album['idalbum']);
                echo "<h2>" . $musique['titre'] . "</h2>";
                echo "<a href=" . $musique['preview'] . ">lien de la musique</a>";
                echo "<br> ISRC : " . $musique['isrc'];
                ?>
                <div>
                    <audio controls style="width: 100%">
                        <?php
                        echo "<source src='" . $musique['preview'] . "' type='audio/mpeg'>"
                        ?>
                    </audio>
                </div>
                <?php
            }
            }
            ?>
        </div>


    </div>


</div>

</body>

</html>