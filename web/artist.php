<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>MUSIC MAP</title>
    <script type="text/javascript" src="fonctions.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script>
</head>

<script>

</script>

<body>
<?php
include 'bar2.php';
include 'fonction_php.php';
?>
<div class="container">
    <?php

    include 'bd.php';

    $bdd = getBD();

    $req = $bdd->prepare("select * from ARTISTE where ARTISTE.idartiste = :idartiste");

    $req->bindParam(':idartiste', $_GET['idartist']);
    $req->execute();
    $row = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();

    # Si non existant dans la BD
    if (!$row) {

        echo '<script>ajout()</script>';

        # Appel api Deezer pour les infos de l'artiste
        $info_d = info_artiste_deezer($_GET['idartist']);

        # Appel api LastFm pour obtenir les artistes similaires et la bio
        $info_l = info_artiste_lasfm($info_d[0]);

        // Nom artiste :
        /*echo '<h2>' . $info_d[0] . '</h2>';
        echo "<img src='" . $info_d[1] . "' />";
        echo "<p>" . $info_l[0] . "</p>";*/

//        echo '<h3>Similaire : </h3>';
//        $nbSim = count($info_l[1]);
//        for ($i = 0; $i < $nbSim; $i++) {
//            echo $info_l[1][$i]->{'name'} . '<br>';
//
//            # récup info deezer pour les similaires avec le nom A FAIRE
////            $sim = recherche_api_deezer($info_l[1][$i]->{'name'}, 1);
////            $id_sim = $sim[0][0];
////            $nom_sim = $sim[1][0];
////            $img_sim = $sim[2][0];
////            #print_r($sim);
////
////            $lFM_sim = info_artiste_lasfm($nom_sim);
//
//            # Risque de dépasser les limites de l'API
//
//            # Permet l'ajout des artistes similaires dans la BD mais ça fait exploser les requetes api
//            #ajout_artiste($bdd, $id_sim, $nom_sim, $lFM_sim[0], $img_sim);
//        }

        $nomArt = str_sansaccent($info_d[0]);
        $albums = recherche_album($_GET['idartist'], $nomArt);


        //echo '<h3>Discographie : </h3>';
        /*for ($i = 0; $i < count($albums[0]); $i++) {
            echo $albums[1][$i] . "<br>";
        }*/
        #var_dump($albums);

        # Ajout a la BD
        if (isset($_SESSION['client'])) {
            try {
                ajout_artiste_mail($bdd, $_GET['idartist'], $info_d[0], $info_l[0], $info_d[1], $_SESSION['client'][4]);
                ajout_contrib($bdd, $_SESSION['client'][4]);

                for ($i = 0; $i < count($albums[0]); $i++) {
                    ajout_albums($bdd, $albums[0][$i], $albums[1][$i], $albums[2][$i], $albums[5][$i], $albums[3][$i], $albums[4][$i]);
                }

                pays_artiste($bdd, $_GET['idartist']);
            } catch (PDOException $e) {
                echo 'Exception reçue : ', $e->getMessage(), "\n";
                echo '<br>';
            }
        } else {
            try {
                ajout_artiste($bdd, $_GET['idartist'], $info_d[0], $info_l[0], $info_d[1]);

                for ($i = 0; $i < count($albums[0]); $i++) {
                    ajout_albums($bdd, $albums[0][$i], $albums[1][$i], $albums[2][$i], $albums[5][$i], $albums[3][$i], $albums[4][$i]);
                }

                pays_artiste($bdd, $_GET['idartist']);
            } catch (PDOException $e) {
                echo 'Exception reçue : ', $e->getMessage(), "\n";
                echo '<br>';
            }
        }

        echo "<meta http-equiv='refresh' content='1;URL=artist.php?idartist=" . $_GET['idartist'] . "'>";

        # Si présent dans la BD
    } else {
        echo '<h2>' . $row['nomartiste'] . '</h2>';
        ?>
        <div class="artiste">
            <div>
                <?php
                echo "<img src='" . $row['imgartiste'] . "' alt=''>";
                ?>
            </div>

            <div>
                <?php
                echo "<h3>Biographie : </h3>";
                echo "<p>" . $row['bio'] . "</p>";
                $pays = nom_pays_artiste($bdd, $row['idartiste']);
                echo "<h3>Pays : " . $pays['nom'] . "</h3>";
                ?>
            </div>
        </div>
        <hr>
        <h3 style="text-align: center">Discographie :</h3>
        <table class="discographie">
            <?php
            $albums = discographie($bdd, $row['idartiste']);
            for ($i = 0; $i < count($albums[0]); $i++) {
                echo "<tr>";
                echo "<td>";
                echo "<img src='" . $albums[1][$i] . "' />";
                echo "</td>";
                echo "<td>";
                echo $albums[0][$i];
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <?php
    }
    ?>

</div>

</body>


</html>