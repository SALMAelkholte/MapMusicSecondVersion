<?php

	if(!empty($_GET['IdClientCommun'])){
			$IdClientCommun = $_GET['IdClientCommun'];
			header('Location:../PlayListCommun.php?IdClientCommunn='.$IdClientCommun);
	}
	elseif (!empty($_GET['idmusic'])) {

		$idmusiq = $_GET['idmusic'];
		DeleteFromPlayList($idmusiq);
		header('Location:../playlist.php');
	
	}elseif (!empty($_GET['IdMusicAdd'])) {
		$IdMusicAdd = $_GET['IdMusicAdd'];
		InsertInPlayList($IdMusicAdd);
	}elseif( !empty($_GET['IdMusicVote'])){
		$IdMusicVote = $_GET['IdMusicVote'];
		echo "$IdMusicVote";
		$msg = UpdateNote($IdMusicVote);
		header('Location:../decouvrir.php?message='.$msg);
	}

	function getConnexion(){
		$servername = "localhost";
		$username = "root";
		$data_base ="musicmap";
		$password = "";

		$conn = new mysqli($servername, $username, $password,$data_base);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		return $conn;
	}

	function GetAll(){
		$con = getConnexion();
	 	$stat = $con->query("select m.idmusique,m.titre,m.urldeezer,a.nomalbum,a.date_sortie,m.duree,ar.imgartiste,ar.nomartiste from musique m, album a, artiste ar, dans_album d,interprete i where  m.idmusique = d.idmusique AND a.idalbum = d.idalbum AND m.idmusique = i.idmusique AND ar.idartiste = i.idartiste");
	 
	  	if($stat->num_rows > 0 ){
		    while($row = $stat->fetch_assoc()) {
		        echo "
				    <div class=\"col-12 col-md-4 single_gallery_item entre wow fadeInUp\" data-wow-delay=\"0.2s\">
				        <div class=\"app-map-music-area style-2 d-flex align-items-center flex-wrap\">
				            <div class=\"app-map-music-thumbnail\">
				              <img src=\"$row[imgartiste]\" alt=\"\">
				            </div>
				            <div class=\"app-map-music-content text-center\">
				                <span class=\"music-published-date mb-2\">$row[date_sortie]</span>
				                <h3>$row[nomalbum]</h3>
					            <div class=\"music-meta-data\">
					            	<p> <a href=\"#\" class=\"music-author\">$row[nomartiste]</a> | <a href=\"#\" class=\"music-catagory\">$row[titre]</a> | <a href=\"#\" class=\"music-duration\">$row[duree]</a></p>
					            </div>
					            <!-- Music Player -->
					            <div class=\"app-map-music-player\">
					            	<audio preload=\"auto\" controls>
					                   <source src=\"$row[urldeezer]\">
					                </audio>
					            </div>
					            <!-- Likes, Share & Download -->
					            <div class=\"likes-share-download d-flex align-items-center justify-content-between\">
					            	<a href=\"traitement/model.php?IdMusicAdd=$row[idmusique]\"><i class=\"fa fa-heart\" aria-hidden=\"true\"></i> Ajouter a votre liste</a>
					            	<a href=\"traitement/model.php?IdMusicVote=$row[idmusique]\"><i class=\"fas fa-thumbs-up\"></i>J'aime</a>
					            </div>
					        </div>
					    </div>
					</div>
		        ";
		    }
		}
		elseif($stat->num_rows == 0){
			echo "Rien trouvé sur votre play list";
		}
	}

	function UpdateNote($IdMusicVote){
		$con = getConnexion();
		$sql = "UPDATE musique SET popularity= popularity +1 WHERE idmusique = $IdMusicVote";

		if ($con->query($sql) === TRUE) {
		    return "ok";
		} else {
		    return "Error: " . $con->error;
		}
	}

	function GetTopFive(){
		$con = getConnexion();
		$stat = $con->query("select m.idmusique,m.titre,m.urldeezer,a.nomalbum,a.date_sortie,m.duree,ar.imgartiste,ar.nomartiste,m.popularity from musique m, album a, artiste ar, dans_album d,interprete i where  m.idmusique = d.idmusique AND a.idalbum = d.idalbum AND m.idmusique = i.idmusique AND ar.idartiste = i.idartiste order by m.popularity DESC LIMIT 5");
	  
	  	if($stat->num_rows > 0 ){
		    while($row = $stat->fetch_assoc()) {
		        echo "
				    <div class=\"col-12 col-md-4 single_gallery_item entre wow fadeInUp\" data-wow-delay=\"0.2s\">
				        <div class=\"app-map-music-area style-2 d-flex align-items-center flex-wrap\">
				            <div class=\"app-map-music-thumbnail\">
				              <img src=\"$row[imgartiste]\" alt=\"\">
				            </div>
				            <div class=\"app-map-music-content text-center\">
				                <span class=\"music-published-date mb-2\">$row[date_sortie]</span>
				                <h3>$row[nomalbum]</h3>
					            <div class=\"music-meta-data\">
					            	<p> <a href=\"#\" class=\"music-author\">$row[nomartiste]</a> | <a href=\"#\" class=\"music-catagory\">$row[titre]</a> | <a href=\"#\" class=\"music-duration\">$row[duree]</a></p>
					            </div>
					            <!-- Music Player -->
					            <div class=\"app-map-music-player\">
					            	<audio preload=\"auto\" controls>
					                   <source src=\"$row[urldeezer]\">
					                </audio>
					            </div>
					            <!-- Likes, Share & Download -->
					            <div class=\"likes-share-download d-flex align-items-center justify-content-between\">
					            	<a href=\"traitement/model.php?IdMusicAdd=$row[idmusique]\"><i class=\"fa fa-heart\" aria-hidden=\"true\"></i> Ajouter a votre liste</a>
					            	<a href=\"traitement/model.php?IdMusicVote=$row[idmusique]\"><i class=\"fas fa-thumbs-up\"></i>J'aime</a>
					            </div>
					        </div>
					    </div>
					</div>
		        ";
		    }
		}

		elseif($stat->num_rows == 0){
			echo "Rien trouvé sur votre play list";
		}
	}

	function getPlayList($idClient){
		$con = getConnexion();

	 	$stat = $con->query("select DISTINCT m.idmusique,m.titre,m.urldeezer,a.nomalbum,a.date_sortie,m.duree,ar.imgartiste,ar.nomartiste  from musique m, album a, artiste ar, dans_album d,interprete i, dans_playlist dp, avoir_playlist ap where  m.idmusique = d.idmusique AND a.idalbum = d.idalbum AND m.idmusique = i.idmusique AND ar.idartiste = i.idartiste AND m.idmusique IN (SELECT idmusique from dans_playlist where idplaylist = (select idplaylist FROM avoir_playlist where mailclient = '$idClient'))");
	  	if($stat->num_rows > 0 ){
		    while($row = $stat->fetch_assoc()) {
		        echo "
				    <div class=\"col-12 col-md-4 single_gallery_item entre wow fadeInUp\" data-wow-delay=\"0.2s\">
				        <div class=\"app-map-music-area style-2 d-flex align-items-center flex-wrap\">
				            <div class=\"app-map-music-thumbnail\">
				              <img src=\"$row[imgartiste]\" alt=\"\">
				            </div>
				            <div class=\"app-map-music-content text-center\">
				                <span class=\"music-published-date mb-2\">$row[date_sortie]</span>
				                <h3>$row[nomalbum]</h3>
					            <div class=\"music-meta-data\">
					            	<p> <a href=\"#\" class=\"music-author\">$row[nomartiste]</a> | <a href=\"#\" class=\"music-catagory\">$row[titre]</a> | <a href=\"#\" class=\"music-duration\">$row[duree]</a></p>
					            </div>
					            <!-- Music Player -->
					            <div class=\"app-map-music-player\">
					            	<audio preload=\"auto\" controls>
					                   <source src=\"$row[urldeezer]\">
					                </audio>
					            </div>
					            <!-- Likes, Share & Download -->
					            <div class=\"likes-share-download d-flex align-items-center justify-content-between\">
					            	<a href=\"traitement/model.php?idmusic=$row[idmusique]\"><i class=\"fa fa-heart\" aria-hidden=\"true\"></i> Retirer de votre liste</a>
									<a href=\"traitement/model.php?IdMusicVote=$row[idmusique]\"><i class=\"fas fa-thumbs-up\"></i>J'aime</a>
					            </div>
					        </div>
					    </div>
					</div>
		        ";
		    }
		}
		elseif($stat->num_rows == 0){
			echo "Rien trouvé sur votre play list";
		}
	}

	function InsertInPlayList($idMusic){
		session_start();
		$con = getConnexion();
		$numplaylist= -1;
		$idplay= null;

		if (isset($_SESSION['client'])) {
			$mailclient = $_SESSION['client'][4];
			$stat = $con->query("SELECT idplaylist FROM avoir_playlist where mailclient = '$mailclient'");
			while ($row = $stat->fetch_assoc()) {
			   	$numplaylist =  $row['idplaylist'];
			}
			if ($numplaylist != -1) {
				$stat1 = $con->query("INSERT INTO dans_playlist(idplaylist,idmusique) VALUES ($numplaylist,$idMusic)");
				echo "<script>alert('musique ajouter à votre playlist')</script>";	
			}else{
				$mailclient2 = $_SESSION['client'][4];
				$stat2 = $con->query("SELECT max(idplaylist) as idplaylist FROM playlist ");
				while ($row = $stat2->fetch_assoc()) {
		    		$idplay =  $row['idplaylist'] + 1;
				}
				$stat3 = $con->query(" INSERT INTO playlist(idplaylist,nomplaylist) values($idplay,$idplay) ");
				$stat4 = $con->query(" INSERT INTO avoir_playlist (idplaylist,mailclient) VALUES ($idplay,'$mailclient2') ");
				$stat5 = $con->query(" INSERT INTO dans_playlist(idplaylist,idmusique) VALUES ($idplay,$idMusic) ");
				echo "<script>alert('musique ajouter à votre playlist')</script>";
			}
			header('Location:../decouvrir.php');
		}else{
		    header('Location:../playlist.php');
		}
	}

	function DeleteFromPlayList($idmusiq){
		session_start();
		$con = getConnexion();

		$mailclient = $_SESSION['client'][4];
		$stat = $con->query("SELECT idplaylist FROM avoir_playlist where mailclient = '$mailclient'");
		while ($row = $stat->fetch_assoc()) {
		   	$numplaylist =  $row['idplaylist'];
		    $stat2 = $con->query("DELETE FROM dans_playlist WHERE idplaylist=$numplaylist and idmusique = $idmusiq");
		}
	}

	function getClientCommun($idClient){
		$con = getConnexion();
		$stat = $con->query("select nomclient, prenomclient, mailclient from client WHERE mailclient in (select mailclient FROM avoir_playlist WHERE idplaylist in (select DISTINCT idplaylist from dans_playlist where idmusique in (select DISTINCT m.idmusique from musique m where m.idmusique IN (SELECT idmusique from dans_playlist where idplaylist = (select idplaylist FROM avoir_playlist where mailclient = '$idClient'))))) AND mailclient != '$idClient'");
	  
	  	if($stat->num_rows > 0 ){
		    while($row = $stat->fetch_assoc()) {
		        echo "
		        	<li class=\"list-group-item\"><a href=\"traitement/model.php?IdClientCommun=$row[mailclient]\" style=\"color:black;\">$row[nomclient] $row[prenomclient]</a></li>
		        ";
		    }
		}

		elseif($stat->num_rows == 0){
			echo "Rien trouvé sur votre play list";
		}
	}

	function getPlayListCommun($idClient){
		$con = getConnexion();

	 	$stat = $con->query("select DISTINCT m.idmusique,m.titre,m.urldeezer,a.nomalbum,a.date_sortie,m.duree,ar.imgartiste,ar.nomartiste  from musique m, album a, artiste ar, dans_album d,interprete i, dans_playlist dp, avoir_playlist ap where  m.idmusique = d.idmusique AND a.idalbum = d.idalbum AND m.idmusique = i.idmusique AND ar.idartiste = i.idartiste AND m.idmusique IN (SELECT idmusique from dans_playlist where idplaylist = (select idplaylist FROM avoir_playlist where mailclient = '$idClient'))");
	  	if($stat->num_rows > 0 ){
		    while($row = $stat->fetch_assoc()) {
		        echo "
				    <div class=\"col-12 col-md-4 single_gallery_item entre wow fadeInUp\" data-wow-delay=\"0.2s\">
				        <div class=\"app-map-music-area style-2 d-flex align-items-center flex-wrap\">
				            <div class=\"app-map-music-thumbnail\">
				              <img src=\"$row[imgartiste]\" alt=\"\">
				            </div>
				            <div class=\"app-map-music-content text-center\">
				                <span class=\"music-published-date mb-2\">$row[date_sortie]</span>
				                <h3>$row[nomalbum]</h3>
					            <div class=\"music-meta-data\">
					            	<p> <a href=\"#\" class=\"music-author\">$row[nomartiste]</a> | <a href=\"#\" class=\"music-catagory\">$row[titre]</a> | <a href=\"#\" class=\"music-duration\">$row[duree]</a></p>
					            </div>
					            <!-- Music Player -->
					            <div class=\"app-map-music-player\">
					            	<audio preload=\"auto\" controls>
					                   <source src=\"$row[urldeezer]\">
					                </audio>
					            </div>
					            <!-- Likes, Share & Download -->
					            <div class=\"likes-share-download d-flex align-items-center justify-content-between\">
					            	<a href=\"traitement/model.php?IdMusicAdd=$row[idmusique]\"><i class=\"fa fa-heart\" aria-hidden=\"true\"></i> Ajouter a votre liste</a>
					            	<a href=\"traitement/model.php?IdMusicVote=$row[idmusique]\"><i class=\"fas fa-thumbs-up\"></i>J'aime</a>
					            </div>
					        </div>
					    </div>
					</div>
		        ";
		    }
		}
		elseif($stat->num_rows == 0){
			echo "Rien trouvé sur votre play list";
		}
	}
?>
