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
<div class="container">

    <?php
    include 'bar2.php';
    include 'fonction_php.php';
    include 'bd.php';
    $bdd = getBD();
    if (isset($_GET['supp'])) {
        supp_playlist($bdd, $_GET['supp'], $_SESSION['client'][4]);
    }
    ?>

    <?php if (isset($_SESSION['client'])) {
    $playlist = recup_playlist($bdd, $_SESSION['client'][4]);
    ?>
    <div class="playlist">
        <div class="lecteurPlaylist">
            <?php
            if (isset($_GET['idmusique'])) {
                $musique = info_musique($bdd, $_GET['idmusique']);
                echo "<h3>" . $musique['nomalbum'] . " - " . $musique['titre'] . "</h3>";
                echo "<img src='" . $musique['coveralbum'] . "' style='max-width: 250px' />";
            } else {
                echo "<h3>Choisissez une musique</h3>";
                echo "<img src='gif/bongo_erreur.gif' style='max-width: 250px' />";
            }
            ?>
            <audio controls style="width: 100%; margin: auto" autoplay="autoplay">
                <?php
                echo "<source src='" . $musique['preview'] . "' type='audio/mpeg'>";
                ?>
            </audio>
        </div>

        <div>
            <h2 style="text-align: center">Ma Playlist</h2>
            <table class="playlistTable">
                <tr>
                    <th>Artiste</th>
                    <th>Titre</th>
                </tr>
                <?php
                foreach ($playlist as $value) {
                    $info = info_musique($bdd, $value);
                    echo "<tr>";
                    echo "<td><a href='artist.php?idartist=" . $info['idartiste'] . "'>";
                    echo $info['nomartiste'];
                    echo "</a></td>";
                    echo "<td><a href='playlists.php?idmusique=" . $value . "'>";
                    echo recup_musique($bdd, $value)['titre'];
                    echo "</a></td>";
                    echo "<td><a href='playlists.php?supp=" . $value . "' style = 'color: #33658a'>";
                    echo "Retirer";
                    echo "</a></td>";
                    echo "</tr>";
                }
                } else {
                    echo '<h1 style="padding: 50px">Veuillez vous connectez pour accéder à vos playlists.</h1>';
                    echo '<p style="text-align: center"><a href="connexion.php">Connectez-vous</a> ou <a href="inscription.php">inscrivez-vous</a> !</p>';
                }
                ?>
            </table>
        </div>
    </div>

</div>

</body>

</html>