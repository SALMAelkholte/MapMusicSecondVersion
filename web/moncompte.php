<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>MUSIC MAP</title>
    <script type="text/javascript" src="fonctions.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js " > </script>

</head>

<body>

<?php include 'bar2.php';
include 'bd.php';
$bdd = getBD();
$rep = $bdd->query("SELECT * FROM CLIENT WHERE mailclient ='". $_SESSION['client'][4]. "' ");
$repco = $rep->fetch();
$_SESSION['client'] = array($repco['nomclient'], $repco['prenomclient'], $repco['pseudo'], $repco['mdpclient'], $repco['mailclient'], $repco['nb_contrib']);
$rep->closeCursor();
?>

<h1 style="padding-top: 30px">Mon compte</h1>
<div class="container">
<table class="table">
    <tr>
        <td>Nom :</td>
        <td><?php echo $_SESSION['client'][0] ?></td>
    </tr>
    <tr>
        <td>Prénom :</td>
        <td><?php echo $_SESSION['client'][1] ?></td>
    </tr>
    <tr>
        <td>Pseudo:</td>
        <td><?php echo $_SESSION['client'][2] ?></td>
    </tr>
    <tr>
        <td>Adresse e-mail:</td>
        <td><?php echo $_SESSION['client'][4]?></td>
    </tr>
    <tr></tr>
    <tr>
        <td>Nombre de contributions :</td>
        <td><?php echo $_SESSION['client'][5] ?></td>
    </tr>
    <tr>
        <td>Statut :</td>
        <td><?php $n = $_SESSION['client'][5];
            if ($_SESSION['client'][5] < 5){
                echo 'Débutant(e)';
                $n = 5 - $n;
                echo '</td></tr><tr><td>Prochain palier :</td><td>'.$n." contributions</td>";
            }
            elseif ($_SESSION['client'][5] < 20 ){
                echo 'Apprenti(e)';
                $n = 20 - $n;
                echo '</td></tr><tr><td>Prochain palier :</td><td>'.$n.' contributions</td>';
            }
            elseif ($_SESSION['client'][5] < 50 ){
                echo 'Musicien(ne)';
                $n = 50 - $n;
                echo '</td></tr><tr><td>Prochain palier :</td><td>'.$n.' contributions</td>';
            }
            elseif ($_SESSION['client'][5] < 100 ){
                echo 'Compositeur(trice)';
                $n = 100 - $n;
                echo '</td></tr><tr><td>Prochain palier :</td><td>'.$n.' contributions</td>';
            }
            elseif ($_SESSION['client'][5] < 200 ){
                echo 'Popstar';
                $n = 200 - $n;
                echo '</td></tr><tr><td>Prochain palier :</td><td>'.$n.' contributions</td>';
            }
            elseif ($_SESSION['client'][5] < 500 ){
                echo 'Rockstar';
                $n = 500 - $n;
                echo '</td></tr><tr><td>Prochain palier :</td><td>'.$n.' contributions</td>';
            }  ?></td>
    </tr>
</table>

    <p><a style="color: red;" href="#" onclick="effa()">Effacer son compte</a></p>

</div>

</body>

</html>