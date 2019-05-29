<?php

function recherche_api_deezer($nom, $limit)
{
    $nom = str_replace(' ', '_', $nom);
    $json_deezer = file_get_contents("https://api.deezer.com/search/artist/?q=" . $nom . "&index=0&limit=" . $limit . "&output=json");
    $parsed_json = json_decode($json_deezer);

    for ($i = 0; $i < count($parsed_json->{'data'}); $i++) {
        $name_artist = array();
        array_push($name_artist, $parsed_json->{'data'}[$i]->{'name'});
        $id_artist = array();
        array_push($id_artist, intval($parsed_json->{'data'}[$i]->{'id'}));
        $img_artist = array();
        array_push($img_artist, $parsed_json->{'data'}[$i]->{'picture_medium'});
        $nbfan_artist = array();
        array_push($nbfan_artist, $parsed_json->{'data'}[$i]->{'nb_fan'});
        $info_deezer = array($id_artist, $name_artist, $img_artist, $nbfan_artist);
        return $info_deezer;
    }
}

function ajout_artiste($bdd, $id, $nom, $bio, $img)
{
    $req = $bdd->prepare("INSERT INTO ARTISTE (idartiste, nomartiste, bio, imgartiste) VALUES(:idartiste, :nom, :bio, :img)");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $req->bindParam(':idartiste', $id);
    $req->bindParam(':nom', $nom);
    $req->bindParam(':bio', $bio);
    $req->bindParam(':img', $img);
    $req->execute();
    $req->closeCursor();
}

function ajout_artiste_mail($bdd, $id, $nom, $bio, $img, $mail)
{
    $req = $bdd->prepare("INSERT INTO ARTISTE (idartiste, nomartiste, bio, imgartiste, mailclient) VALUES(:idartiste, :nom, :bio, :img, :mailclient)");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $req->bindParam(':idartiste', $id);
    $req->bindParam(':nom', $nom);
    $req->bindParam(':bio', $bio);
    $req->bindParam(':img', $img);
    $req->bindParam(':mailclient', $mail);
    $req->execute();
    $req->closeCursor();
}

function info_artiste_deezer($id)
{
    # Appel api Deezer pour les infos de l'artiste
    $json_deezer = file_get_contents("https://api.deezer.com/artist/" . $id);
    $parsed_json = json_decode($json_deezer);
    $name_artist = $parsed_json->{'name'};
    $img_artist = $parsed_json->{'picture_medium'};
    unset($json_deezer);
    unset($parsed_json);
    return array($name_artist, $img_artist);
}

function info_artiste_lasfm($nom)
{
    # Appel api LastFm pour obtenir les artistes similaires et la bio
    $json_lastfm = file_get_contents("http://ws.audioscrobbler.com/2.0?method=artist.getinfo&artist=" . $nom . "&api_key=42532cda65558a05d69251a386717a0f&format=json");
    $parsed_json = json_decode($json_lastfm);
    $bio_artist = $parsed_json->{'artist'}->{'bio'}->{'summary'};
    $similar_artist = $parsed_json->{'artist'}->{'similar'}->{'artist'};
    unset($parsed_json);
    unset($json_lastfm);
    return array($bio_artist, $similar_artist);
}

function ajout_contrib($bdd, $mail)
{
    $req = $bdd->prepare("UPDATE CLIENT
                          SET nb_contrib = nb_contrib + 1
                          WHERE mailclient = :mail");
    $req->bindParam(':mail', $mail);
    $req->execute();
    $req->closeCursor();
}

function recherche_album($id_artist, $nom_artist)
{
    # Appel api Deezer pour obtenir les infos sur les albums de l'artiste*
    $nom_artistC = str_replace(' ', '_', $nom_artist);
    $json_album = file_get_contents("https://api.deezer.com/search/album?q=" . $nom_artistC);
    $parsed_json = json_decode($json_album);

    $album_id = array();
    $album_nom = array();
    $album_cover = array();
    $album_genreid = array();
    $album_tracklist = array();
    $album_idartist = array();

    for ($i = 0; $i < count($parsed_json->{'data'}); $i++) {
        if ($parsed_json->{'data'}[$i]->{'artist'}->{'id'} == $id_artist) {
            array_push($album_id, $parsed_json->{'data'}[$i]->{'id'});
            array_push($album_nom, $parsed_json->{'data'}[$i]->{'title'});
            array_push($album_cover, $parsed_json->{'data'}[$i]->{'cover_medium'});
            array_push($album_genreid, $parsed_json->{'data'}[$i]->{'genre_id'});
            array_push($album_tracklist, $parsed_json->{'data'}[$i]->{'tracklist'});
            array_push($album_idartist, $parsed_json->{'data'}[$i]->{'artist'}->{'id'});
        }
    }

    $albums = array($album_id, $album_nom, $album_cover, $album_genreid, $album_tracklist, $album_idartist);

    unset($json_album);
    unset($parsed_json);

    return $albums;
}

function ajout_albums($bdd, $id, $nom, $cover, $idArtist, $genre, $track)
{
    $req = $bdd->prepare("INSERT INTO ALBUM (idalbum, nomalbum, coveralbum, idartiste, idgenre, tracklist) VALUES(:id, :nom, :cover, :idartiste, :genre, :track)");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $req->bindParam(':id', $id);
    $req->bindParam(':nom', $nom);
    $req->bindParam(':cover', $cover);
    $req->bindParam(':idartiste', $idArtist);
    $req->bindParam(':genre', $genre);
    $req->bindParam(':track', $track);
    $req->execute();
    $req->closeCursor();
}

function str_sansaccent($str)
{
    $sansAccent = $str;
    $sansAccent = preg_replace('#Ç#', 'C', $sansAccent);
    $sansAccent = preg_replace('#ç#', 'c', $sansAccent);
    $sansAccent = preg_replace('#è|é|ê|ë#', 'e', $sansAccent);
    $sansAccent = preg_replace('#È|É|Ê|Ë#', 'E', $sansAccent);
    $sansAccent = preg_replace('#à|á|â|ã|ä|å#', 'a', $sansAccent);
    $sansAccent = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $sansAccent);
    $sansAccent = preg_replace('#ì|í|î|ï#', 'i', $sansAccent);
    $sansAccent = preg_replace('#Ì|Í|Î|Ï#', 'I', $sansAccent);
    $sansAccent = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $sansAccent);
    $sansAccent = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $sansAccent);
    $sansAccent = preg_replace('#ù|ú|û|ü#', 'u', $sansAccent);
    $sansAccent = preg_replace('#Ù|Ú|Û|Ü#', 'U', $sansAccent);
    $sansAccent = preg_replace('#ý|ÿ#', 'y', $sansAccent);
    $sansAccent = preg_replace('#Ý#', 'Y', $sansAccent);

    return ($sansAccent);
}

function album_alea($bdd, $idArtist)
{
    $req = $bdd->prepare("SELECT ALBUM.idalbum, ALBUM.nomalbum, ALBUM.idartiste, ALBUM.tracklist, ALBUM.coveralbum FROM ALBUM, ARTISTE WHERE ARTISTE.idartiste = :idArt AND ALBUM.idartiste = ARTISTE.idartiste ORDER BY RAND() LIMIT 1 ");
    $req->bindParam(':idArt', $idArtist);
    $req->execute();
    $row = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $row;
}

function musique_alea($bdd, $idAlbum)
{
    $req = $bdd->prepare("SELECT * FROM MUSIQUE WHERE MUSIQUE.idalbum = :idalb ORDER BY RAND() LIMIT 1 ");
    $req->bindParam(':idalb', $idAlbum);
    $req->execute();
    $row = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $row;
}

function ajout_tracklist($bdd, $tracklist_url, $idalbum, $idartiste)
{
    $json_tracks = file_get_contents($tracklist_url);
    $parsed_json = json_decode($json_tracks);
    for ($i = 0; $i < count($parsed_json->{'data'}); $i++) {
        $id = $parsed_json->{'data'}[$i]->{'id'};
        $titre = $parsed_json->{'data'}[$i]->{'title'};
        $duree = $parsed_json->{'data'}[$i]->{'duration'};
        $num = $parsed_json->{'data'}[$i]->{'track_position'};
        $rank = $parsed_json->{'data'}[$i]->{'rank'};
        $preview = $parsed_json->{'data'}[$i]->{'preview'};
        $isrc = $parsed_json->{'data'}[$i]->{'isrc'};

        $req = $bdd->prepare("INSERT INTO MUSIQUE (idmusique, titre, duree, numalbum, rank_, preview, isrc, idalbum, idartiste) VALUES(:id, :titre, :duree, :numalbum, :rank_, :preview, :isrc, :idalbum, :idartiste)");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req->bindParam(':id', $id);
        $req->bindParam(':titre', $titre);
        $req->bindParam(':duree', $duree);
        $req->bindParam(':numalbum', $num);
        $req->bindParam(':rank_', $rank);
        $req->bindParam(':preview', $preview);
        $req->bindParam(':isrc', $isrc);
        $req->bindParam(':idalbum', $idalbum);
        $req->bindParam(':idartiste', $idartiste);
        $req->execute();
        $req->closeCursor();
    }

}

function check_artiste($bdd, $id)
{
    $req = $bdd->prepare("SELECT * FROM ARTISTE WHERE ARTISTE.idartiste = :idartiste");
    $req->bindParam(':idartiste', $id);
    $req->execute();
    $row = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $row;
}

function pays_artiste($bdd, $idartiste)
{
    $album = album_alea($bdd, $idartiste);
    $musique = musique_alea($bdd, $album['idalbum']);
    if ($musique) {
        $isrc = $musique['isrc'];
    } else {
        ajout_tracklist($bdd, $album['tracklist'], $album['idalbum'], $album['idartiste']);
        $musique = musique_alea($bdd, $album['idalbum']);
        $isrc = $musique['isrc'];
    }

    $pays = $isrc[0] . $isrc[1];

    $req = $bdd->prepare("UPDATE ARTISTE SET ARTISTE.pays = :pays WHERE ARTISTE.idartiste = :idartiste");
    $req->bindParam(':pays', $pays);
    $req->bindParam(':idartiste', $idartiste);
    $req->execute();
    $req->closeCursor();

    return $isrc;
}

function musique_pays($bdd, $pays)
{
    $titre = array();
    $artiste = array();
    $preview = array();

    $musiques = array($titre, $artiste, $preview);

    $req = $bdd->prepare("
    SELECT MUSIQUE.preview, MUSIQUE.titre, ARTISTE.pays, ARTISTE.nomartiste, MUSIQUE.idmusique, ARTISTE.idartiste
    FROM MUSIQUE, ARTISTE
    WHERE MUSIQUE.idartiste = ARTISTE.idartiste
    AND ARTISTE.pays = :pays
    ORDER BY RAND()
    LIMIT 1
    ");
    $req->bindParam(':pays', $pays);
    $req->execute();
    $row = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();

    $req = $bdd->prepare("UPDATE MUSIQUE SET MUSIQUE.nbecoutes = MUSIQUE.nbecoutes + 1 WHERE MUSIQUE.idmusique = " . $row['idmusique']);
    $req->bindParam(':pays', $pays);
    $req->execute();
    $req->closeCursor();

    return $row;
}

function musique_découvrir($bdd, $rank)
{
    if ($rank == '0') {
        $req = $bdd->prepare("SELECT * FROM MUSIQUE, ARTISTE WHERE rank_ > 900000 AND MUSIQUE.idartiste = ARTISTE.idartiste ORDER BY RAND() LIMIT 1");
        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
    } elseif ($rank == '1') {
        $req = $bdd->prepare("SELECT * FROM MUSIQUE, ARTISTE WHERE rank_ < 1000 AND MUSIQUE.idartiste = ARTISTE.idartiste ORDER BY RAND() LIMIT 1");
        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
    } elseif ($rank =='3') {
        $req = $bdd->prepare("SELECT * FROM MUSIQUE, ARTISTE where MUSIQUE.idartiste = ARTISTE.idartiste ORDER BY RAND() LIMIT 1");
        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
    }
    return $row;
}

function ajout_playlist($bdd, $idmusique, $idclient)
{
    $req = $bdd->prepare("INSERT INTO PLAYLIST (idmusique, idclient) VALUES(:idmusique, :idclient)");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $req->bindParam(':idmusique', $idmusique);
    $req->bindParam(':idclient', $idclient);
    $req->execute();
    $req->closeCursor();
    return true;
}

function artiste_pays($bdd, $pays)
{
    $req = $bdd->prepare("
    SELECT ARTISTE.idartiste, ARTISTE.nomartiste
    FROM ARTISTE
    WHERE ARTISTE.pays = :pays
    ORDER BY RAND() LIMIT 1
    ");
    $req->bindParam(':pays', $pays);
    $req->execute();
    $row = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $row;
}

function recup_playlist($bdd, $idclient)
{
    $playlist = array();
    $req = $bdd->prepare("
    SELECT * 
    FROM PLAYLIST
    WHERE PLAYLIST.idclient = :idclient
    ORDER BY PLAYLIST.idplaylist
    ");
    $req->bindParam(':idclient', $idclient);
    $req->execute();
    while ($row = $req->fetch()) {
        array_push($playlist, $row['idmusique']);
    }
    $req->closeCursor();
    return $playlist;
}

function recup_musique($bdd, $idmusique)
{
    $req = $bdd->prepare("
    SELECT * 
    FROM MUSIQUE
    WHERE MUSIQUE.idmusique = :idmusique
    ");
    $req->bindParam(':idmusique', $idmusique);
    $req->execute();
    $row = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $row;
}

function info_musique($bdd, $idmusique)
{
    $req = $bdd->prepare("
    SELECT ARTISTE.nomartiste, MUSIQUE.titre, ALBUM.nomalbum, ALBUM.coveralbum, ARTISTE.idartiste, MUSIQUE.preview
    FROM ARTISTE, MUSIQUE, ALBUM
    WHERE MUSIQUE.idmusique = :idmusique
    AND MUSIQUE.idartiste = ARTISTE.idartiste
    AND MUSIQUE.idalbum = ALBUM.idalbum
    ");
    $req->bindParam(':idmusique', $idmusique);
    $req->execute();
    $row = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $row;
}

function supp_playlist($bdd, $idmusique, $idclient)
{
    $req = $bdd->prepare("DELETE FROM PLAYLIST WHERE PLAYLIST.idclient = :idclient AND PLAYLIST.idmusique = :idmusique");
    $req->bindParam(':idmusique', $idmusique);
    $req->bindParam(':idclient', $idclient);
    $req->execute();
    $req->closeCursor();
}

function nom_pays_artiste($bdd, $idartiste)
{
    $req = $bdd->prepare("
    SELECT ARTISTE.pays, PAYS.nom 
    FROM ARTISTE, PAYS
    WHERE ARTISTE.idartiste = :idartiste
    AND ARTISTE.pays = PAYS.code
    ");
    $req->bindParam(':idartiste', $idartiste);
    $req->execute();
    $row = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $row;
}

function discographie($bdd, $idartiste)
{
    $nom = array();
    $cover = array();
    $req = $bdd->prepare("SELECT * FROM ALBUM WHERE ALBUM.idartiste = :idartiste");
    $req->bindParam(':idartiste', $idartiste);
    $req->execute();
    while ($row = $req->fetch()) {
        array_push($nom, $row['nomalbum']);
        array_push($cover, $row['coveralbum']);
    }
    $req->closeCursor();
    $albums = array($nom, $cover);
    return $albums;
}

?>