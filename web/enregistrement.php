<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>MUSIC MAP</title>
    <?php
    if($_POST['n'] =="" or $_POST['p']=="" or $_POST['ps']=="" or $_POST['mdp1']=="" or $_POST['mdp2']=="" or $_POST['mail']=="" or $_POST['mdp1'] != $_POST['mdp2']){
        echo "<meta http-equiv='refresh' content='3;url=inscription.php?n=".$_POST['n']."&p=".$_POST['p']."&ps=".$_POST['ps']."&mail=".$_POST['mail']."' />";}
    else{
        echo "<meta http-equiv='refresh' content='3;url=index.php' />";}
    ?>
</head>

<body>

<?php include 'bar2.php'; ?>
<?php include 'bd.php'?>

<?php
function enregistrer($nom, $prenom, $pseudo, $mdp, $mail)
{
    $bdd = getBD();
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $req = "INSERT INTO CLIENT VALUES('" . $nom . "','" . $prenom . "', '" . $pseudo . "', '" . $mdp . "', '" . $mail . "', '". null ."')";
    $bdd->exec($req);}
?>

<?php
if($_POST['n'] =="" or $_POST['p']=="" or $_POST['ps']=="" or $_POST['mail']=="" or $_POST['mdp1']=="" or $_POST['mdp2']=="" or $_POST['mdp1'] != $_POST['mdp2']){
    echo'<p class="centrer">Informations incorrects</p>';}
else{
    try {
        enregistrer($_POST['n'], $_POST['p'], $_POST['ps'], $_POST['mdp1'], $_POST['mail']);
        echo'<div>
    <h1 style="padding: 50px">Bienvenue !</h1>
    <div class="gif"><img src=\'assets/img/gif/Bienvenue.gif\'></div>
    </div>';
    } catch (PDOException $e) {
        echo 'Exception reçue : ', $e->getMessage(), "\n";
        echo '<br>';
    }
}; ?>

</body>

</html>