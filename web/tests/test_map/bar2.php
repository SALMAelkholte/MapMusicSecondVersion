<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php session_start(); ?>
<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>

<div class="topnav" id="myTopnav">
    <a href="index.php" class="active"><img src="assets/img/titre.png" alt=""></a>
    <a href="">Mes playlists</a>
    <a href="">Découvrir</a>
    <a href="leaderboard.php">Leaderboard</a>
    <a href="rechercher.php">Rechercher</a>
    <?php if (isset($_SESSION['client'])) {
        echo '<a href="deconnexion.php">Mon compte</a>';
        echo '<a href="deconnexion.php"><img class="icone" src="assets/img/icons/powerok.png"></a>';
    } else {
        echo '<a href="connexion.php">Connexion</a>';
        echo '<a href="connexion.php"><img class="icone" src="assets/img/icons/powerNo.png"></a>';
    }
    ?>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>

</div>
<hr style="max-width: 1040px">
