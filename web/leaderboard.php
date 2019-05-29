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
?>

<div class="container">

    <table class="leaderboard">
        <tr>
            <th>Classement</th>
            <th>Pseudo</th>
            <th>Contributions</th>
        </tr>
        <?php
        $bdd = getBD();
        $rep = $bdd->query("SELECT pseudo, nb_contrib FROM CLIENT WHERE nb_contrib IS NOT null AND nb_contrib != 0 ORDER BY nb_contrib DESC");
        $i = 1;
        while ($ligne = $rep -> fetch() and $i < 100){
            if ($i == 1) {
                echo "\n<tr>\n<td>".$i.". </td> \n<td>".$ligne['pseudo']."</td>\n<td>".$ligne['nb_contrib']."</td> \n <td><img style='width: 30px' src='assets/img/Médailles/Disque-or.png'></td></tr>";
            }
            elseif ($i == 2) {
                echo "\n<tr>\n<td>".$i.". </td> \n<td>".$ligne['pseudo']."</td>\n<td>".$ligne['nb_contrib']."</td> \n <td><img style='width: 30px' src='assets/img/Médailles/Disque-arg.png'></td></tr>";
            }
            elseif ($i==3){
                echo "\n<tr>\n<td>".$i.". </td> \n<td>".$ligne['pseudo']."</td>\n<td>".$ligne['nb_contrib']."</td> \n <td><img style='width: 30px' src='assets/img/Médailles/Disque-bron.png'></td></tr>";
            }
            else{
                echo "\n<tr>\n<td>".$i.". </td> \n<td>".$ligne['pseudo']."</td>\n<td>".$ligne['nb_contrib']."</td> \n</tr>";
            }
            $i++;
        }
        ?>
    </table>
</div>

</body>

</html>