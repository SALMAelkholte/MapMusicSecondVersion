<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="fonctions.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js " > </script>

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
    window.onload=function(){
        var bouton = document.getElementById('btnMenu');
        var nav = document.getElementById('nav');
        bouton.onclick = function(e){
            if(nav.style.display=="block"){
                nav.style.display="none";
            }else{
                nav.style.display="block";
            }
        };
    };

</script>

<div class="topnav" id="myTopnav">
    <a href="index.php" class="active"><img src="assets/img/titre.png" alt=""></a>
    <a href="playlists.php">Ma playlist</a>
    <a href="découvrir.php">Découvrir</a>
    <a href="leaderboard.php">Leaderboard</a>
    <a href="#" onclick="rechercher()">Rechercher</a>
    
    <a href="NouvellePartie/decouvrir.php">Nouvelle Partie</a>



    <?php if (isset($_SESSION['client'])) {
        echo '<a href="moncompte.php">Mon compte</a>';
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
