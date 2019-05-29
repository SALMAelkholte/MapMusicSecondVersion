<!DOCTYPE html>
<html lang="fr">

<head>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <script type="text/javascript" src="fonctions.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src = " https://unpkg.com/sweetalert/dist/sweetalert.min.js " > </script>
   <link rel="stylesheet" href="../style.css" type="text/css"/>
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
  
  <link rel="stylesheet" href="style.css">
  
  <style>
    .topnav{
      background-color: #111111;
    }
    .map-app-music-player{
      margin-left: -20px;
    }
    body{
      background-color: #181818;
    }
  </style>
</head>

<body>
  <div class="topnav" id="myTopnav">
      <a href="../index.php" class="active"><img src="../assets/img/titre.png" alt=""></a>
      <a href="../playlists.php">Ma playlist</a>
      <a href="../découvrir.php">Découvrir</a>
      <a href="../leaderboard.php">Leaderboard</a>
      <a href="#" onclick="rechercher()">Rechercher</a>
      <a href="../NouvellePartie/decouvrir.php">Nouvelle Partie</a>
      <?php if (isset($_SESSION['client'])) {
          echo '<a href="../moncompte.php">Mon compte</a>';
          echo '<a href="../deconnexion.php"><img class="icone" src="../assets/img/icons/powerok.png"></a>';
      } else {
          echo '<a href="../connexion.php">Connexion</a>';
          echo '<a href="../connexion.php"><img class="icone" src="../assets/img/icons/powerNo.png"></a>';
      }
      ?>
      <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
      </a>
  </div>
  <hr style="max-width: 1040px">

  <center><div style="color: white;"> Nouvelle Partie - Mes playlists</div></center>

  <nav style="background: rgb(46, 46, 46);"  class="navbar navbar-expand-lg navbar-light" style="background-color: #0000009e;">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item "><a class="nav-link" href="decouvrir.php" style="color: white;">Tout</a></li>
        <li class="nav-item "><a class="nav-link" href="topdumoment.php" style="color: white;">Top 5 du Moment</a></li>
        <li class="nav-item active"> <a class="nav-link" href="playlist.php" style="color: red;">Mes playlists</a></li>
        <li class="nav-item">       <a class="nav-link" href="MemeMusique.php" style="color: white;">Même musiques</a></li>
      </ul>
    </div>
  </nav>
      <?php
        require_once('traitement/model.php');
        if (isset($_SESSION['client'])) {
            echo '<section style="background: rgb(46, 46, 46);" class="map-app-latest-epiosodes section-padding-80">';
              echo '<div class="container">';
                echo '<div class="row map-app-portfolio">';

                  getPlayList($_SESSION['client'][4]);

                echo '</div>';
              echo '</div>';
            echo '</section>';
        }else{
            echo '<section style="background: rgb(46, 46, 46);" class="map-app-latest-epiosodes">';
              echo '<div class="container">';
                echo '<div class="row map-app-portfolio">';

                  echo '<h1 style="color :white">Veuillez vous connectez pour accéder à vos playlists.</h1>';
                  echo '<p><a href="../connexion.php">Connectez-vous</a> ou <a href="../inscription.php">inscrivez-vous</a> !</p>';

                echo '</div>';
              echo '</div>';
            echo '</section>';
        }
      ?>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>