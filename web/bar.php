<div class="header">
    <div class="menu">

        <div style="padding-left: 15px"><a href="index.php">Accueil</a></div>

        <div style="padding-left: 15px"><a href="playlists.php">Mes playlists</a></div>

        <div style="padding-left: 15px"><a href="">Découvrir</a></div>


    </div>

    <div>
        <img src="assets/img/titre.png" alt="" class="titre">
    </div>

    <?php session_start(); ?>


    <div style="padding-right: 15px">
        <form action="recherche.php" method="get">
            <input name="r" type="text" placeholder="Rechercher"/>
            <input type="submit" value="Go !"/>

            <?php if (isset($_SESSION['client'])) {
                echo '<a href="deconnexion.php" style="padding-left: 15px">Mon compte</a>';
                echo '<a href="deconnexion.php" style="padding-left: 15px"><img class="icone" src="assets/img/icons/powerok.png"></a>';
            } else {
                echo '<a href="connexion.php" style="padding-left: 15px">Connexion</a>';
                echo '<a href="connexion.php" style="padding-left: 15px"><img class="icone" src="assets/img/icons/powerNo.png"></a>';
            }
            ?>
        </form>

    </div>


</div>

<hr>
</html>