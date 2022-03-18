<?php
session_start();
$id_membres = $_SESSION["membres"]["id"];
require_once "includes/bddconnexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto:wght@300&display=swap"
        rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- pour les etoiles  -->
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Document</title>
</head>

<body>


    <?php include('includes/navbar.php');

    


    // la table avoir acteur = aa et acteur = a et film = f
    // ou id acteur de la table acteur = id acteur de la table avoir acteur
    // et id film de la table avoir acteur = id film de la table film 
    //  et id film de la table film = au get
    $infofilm = "SELECT * FROM `avoir_acteurs` aa, `acteurs` a, `films` f 
    WHERE a.id_acteurs = aa.id_acteurs and aa.id_films = f.id_films and f.id_films = " . $_GET["id_film"] . "";
    $requeteinfofilm = $db->prepare($infofilm);
    $requeteinfofilm->execute();
    $afficheinfofilm = $requeteinfofilm->fetch();

    $originalHeure = $afficheinfofilm['duree_films'];
    //original date is in format YYYY-mm-dd
    $timestamp = strtotime($originalHeure);
    $heure = date("H", $timestamp);
    $minutes = date("i", $timestamp);

    $originalDate = $afficheinfofilm['datesortie_films'];
    //original date is in format YYYY-mm-dd
    $timestamp2 = strtotime($originalDate);
    $date = date("d/m/Y", $timestamp2);

    // $heure = date("H:i", $afficheinfofilm['duree_films']);

    ?>



    <div class="container">

        <div class="fondecranfilm">

            <div class="fondfilm"><img src="img/films/<?php echo $afficheinfofilm['affiche_films']; ?>" alt=""></div>

            <!-- <div class="nomdufilm">Red Notice</div> -->

        </div>


        <div class="favoris" id="favoris">
            <?php

            // ici on traite l'ajout en favoris ou non
            if (isset($_GET["action"])) {
                if ($_GET["action"] == "favoris") {

                    $sqlfavoris1 = "SELECT COUNT(*) FROM avoir_favoris WHERE id_films=:id_films AND id_membres=:id_membres";
                    $requetefavoris1 = $db->prepare($sqlfavoris1);
                    $requetefavoris1->execute(
                        array(
                            ":id_films" => $_GET["id_film"], 
                            ":id_membres" => $id_membres
                        ));

                    $nombrefavorisp = $requetefavoris1->fetchColumn();

                    if ($nombrefavorisp >= 1) {
                        echo "Ce film est déjà dans vos favoris";
                    } else {

                        $sqlfavoris = "INSERT INTO `avoir_favoris`(`id_films`, `id_membres`) VALUES (:id_films, :id_membres)";

                        $id_membres = $_SESSION["membres"]["id"];

                        $requetefavoris = $db->prepare($sqlfavoris);
                        $requetefavoris->execute(array(
                            ":id_films" => $_GET["id_film"],
                            ":id_membres" => $id_membres
                        ));  

                        echo '<div class="rouge">Féliciation nous avons ajoutés le film à vos favoris</div>';
                    }
                }

                if ($_GET["action"] == "nofavoris") {
                    $sqlfavoris1 = "SELECT COUNT(*) FROM avoir_favoris WHERE id_films=:id_films AND id_membres=:id_membres";
                    $requetefavoris1 = $db->prepare($sqlfavoris1);
                    $requetefavoris1->execute(array(
                        ":id_films" => $_GET["id_film"],
                        ":id_membres" => $id_membres
                    ));  
                    $nombrefavorisp = $requetefavoris1->fetchColumn();

                    if ($nombrefavorisp >= 1) {
                        // on supprime

                        $sqlsupprfavoris = "DELETE FROM `avoir_favoris` WHERE id_films=:id_films AND id_membres=:id_membres";
                        $requetesupprfavoris = $db->prepare($sqlsupprfavoris);
                        $requetesupprfavoris->execute(
                            array(
                                ":id_films" => $_GET["id_film"],
                                ":id_membres" =>  $id_membres
                            ));

                        echo '<div class="rouge">Le film est supprimé de vos favoris</div>';
                    } else {
                        echo '<div class="rouge">Le film n\'est plus dans vos favoris</div>';
                    }
                }
                
                if ($_GET["action"] == "note") {

                    $sqlnoteperso = "SELECT * FROM notation WHERE id_membres=:id_membre AND id_films=:id_films";
                    $requetenoteperso = $db->prepare($sqlnoteperso);
                    $requetenoteperso->execute(
                        array(
                            ":id_membre" => $_SESSION["membres"]["id"],
                            ":id_films" => $_GET["id_film"]
                        ));
                    $affichenotecountperso = $requetenoteperso->rowCount();  

                    $notemise = $_POST["note"];

                    if ($notemise > '5') {
                        echo '<div class="rouge">Désolé il y a une erreur dans le traitement de la note</div>';
                    }
                    if ($notemise < '1') {
                        echo '<div class="rouge">Désolé il y a une erreur dans le traitement de la note</div>';
                    }
                    else {

                        if ($affichenotecountperso >= 1) { echo " Vous avez déjà voter pour ce film.";}
                        if ($affichenotecountperso == 0) { 
                    // on ajoute dans notation l'id du film, l'id du membre et la note

                    $sqlfavoris = "INSERT INTO `notation`(`note_notation`, `id_films`, `id_membres`) 
                    VALUES (:note, :id_films, :id_membres)";

                    $id_membres = $_SESSION["membres"]["id"];

                    $requetefavoris = $db->prepare($sqlfavoris);
                    $requetefavoris->execute(array(
                        ":note" =>$notemise,
                        ":id_films" => $_GET["id_film"],
                        ":id_membres" => $_SESSION["membres"]["id"]
                    ));  

                    echo "Votre vote est pris en compte";
                }
            }

                }

                if ($_GET["action"] == "notesuppr") {

                    $sqlsupprnote = "DELETE FROM notation WHERE id_membres =:id_membres AND id_films=:id_films";
                    $requetesupprnote = $db->prepare($sqlsupprnote);
                    $requetesupprnote->execute(
                        array(
                            ":id_membres" => $_SESSION["membres"]["id"],
                            ":id_films" => $_GET["id_film"],
                        ));
                    $affichesupprnote = $requetesupprnote->fetch();

                    echo "Votre note est supprimé";
                }

            }

            ?>

        </div>

        <div class="informationfilm">

            <div class="informationresume">
                <div class="informationtitre">Informations</div>
                Temps du film : <?php echo $heure . "h" . $minutes . "min"; ?><br>
                Date de sortie : <?php echo $date; ?><br>
                Pegi : +<?php echo $afficheinfofilm['pegi_films']; ?>ans<br>
                Genre :
                <?php

                $infofilm2 = "SELECT * FROM `films` f, `avoir_genres` ag, `genres` g 
                WHERE g.id_genres = ag.id_genres and ag.id_films = f.id_films 
                AND f.id_films = :id_film";
                $requeteinfofilm2 = $db->prepare($infofilm2);
                $requeteinfofilm2->execute(
                    array(
                        ":id_film" => $_GET["id_film"]
                    ));
                $afficheinfofilm22 = $requeteinfofilm2->fetchAll();

                $affichegenre = implode(", ", array_map(function ($el) { return $el["genre_genres"];}, $afficheinfofilm22)); // string(20) "lastname,email,phone"

                echo $affichegenre;

                // foreach ($afficheinfofilm22 as $key=>$afficheinfofilm222)
                // {   
                //  if ($key != 0) {echo ", ";}
                //     echo $afficheinfofilm222["genre_genres"];
                // }
                ?>
                <br><br>
                Ajouter à ma liste :

                <?php

                $sqlfavoris2 = "SELECT COUNT(*) FROM avoir_favoris WHERE id_films=:id_films AND id_membres=:id_membres";
                $requetefavoris2 = $db->prepare($sqlfavoris2);
                $requetefavoris2->execute(
                    array(
                        ":id_films" => $_GET["id_film"],
                        ":id_membres" => $id_membres
                    ));
                $nombrefavorisp2 = $requetefavoris2->fetchColumn();

                if ($nombrefavorisp2 >= "1") {
                ?>
                <a href="film.php?id_film=<?php echo $_GET['id_film']; ?>&action=nofavoris#favoris"><i
                        class="fa-solid fa-heart"></i></a>
                <?php
                } else {
                ?>
                <a href="film.php?id_film=<?php echo $_GET['id_film']; ?>&action=favoris#favoris"> <i
                        class="fa-regular fa-heart"></i> </a>
                <?php
                }

                ?>
                <br><br>
                <?php 
                $sqlnote = "SELECT * FROM notation WHERE  id_films=:id_films";
                $requetenote = $db->prepare($sqlnote);
                $requetenote->execute(
                    array(
                        ":id_films" =>$_GET["id_film"]
                    ));
                $affichenotecount = $requetenote->rowCount();  
                $affichenotecount2 = $requetenote->columnCount();  // nombre total de vote 
                $affichenote = $requetenote->fetch();

                $sqlnoteperso = "SELECT * FROM notation WHERE id_membres=".$_SESSION["membres"]["id"]." AND id_films=".$_GET["id_film"]."";
                $requetenoteperso = $db->prepare($sqlnoteperso);
                $requetenoteperso->execute();
                $affichenotecountperso = $requetenoteperso->rowCount();  


                $sqlnotesomme = "SELECT SUM(`note_notation`) as totalnote FROM notation WHERE id_films=:id_films";
                $requetenotesomme = $db->prepare($sqlnotesomme);
                $requetenotesomme->execute(
                    array(
                        ":id_films" =>$_GET["id_film"]
                    ));
                $affichesomme = $requetenotesomme->fetch();

                // ici on dit que si on divise par zero alors on met zero pour lamoyenne sinon on fait le calcul
                
                if ($affichenotecount == 0) {$moyennefilm = 0;}
                else { $moyennefilm = $affichesomme["totalnote"] / $affichenotecount;}



                if ($affichenotecountperso == 1){echo "Vous avez voté : "; echo $affichenote["note_notation"]; echo "/5";
                    ?>
                <a href="film.php?id_film=<?php echo $_GET['id_film']; ?>&action=notesuppr#favoris">
                    <i class='fa-solid fa-trash-can delete'></i></a>
                <?php 
                 }
                else {
?>
                <form action="film.php?id_film=<?php echo $_GET['id_film']; ?>&action=note#favoris" method="post">
                    <div class="stars">
                        Vote : <i class="lar la-star" data-value="1"></i><i class="lar la-star" data-value="2"></i><i
                            class="lar la-star" data-value="3"></i><i class="lar la-star" data-value="4"></i><i
                            class="lar la-star" data-value="5"></i>
                    </div>

                    <input type="hidden" name="note" id="note" value="0">
                    <!-- mettre hidden apres  -->
                    <input type="submit" class="vote" value="Je valide ma note">
                </form>
                <?php
                }
?>
                <br>
                Note moyenne : <?php echo $moyennefilm?>/5
                (<?php echo $affichenotecount; echo $affichenotecount>1?" votes":" vote"; ?>)
            </div>


            <div class="informationinfo">
                <div class="informationtitre">Synopsis</div>

                <?php echo $afficheinfofilm['synopsis_films']; ?>


            </div>
            <div class="informationacteurs">
                <div class="informationtitre">Acteurs</div>

                <?php

                $infofilm3 = "SELECT * FROM `films` f, `avoir_acteurs` aa, `acteurs` a 
                WHERE a.id_acteurs = aa.id_acteurs and aa.id_films = f.id_films 
                AND f.id_films = " . $_GET["id_film"] . "";
                $requeteinfofilm3 = $db->prepare($infofilm3);
                $requeteinfofilm3->execute();
                $afficheinfofilm3 = $requeteinfofilm3->fetchAll();


                foreach ($afficheinfofilm3 as $afficheinfofilm2) {
                    echo $afficheinfofilm2["prenom_acteurs"] . " ";
                    echo $afficheinfofilm2["nom_acteurs"];
                    echo "<br>";
                }

                ?>


            </div>

        </div>


        <!-- <div class="seperationhr">
        <hr class="style-two">
        </hr>
    </div> -->

        <div class="bandeannonce">

            <div class="video2"> <video width="500" height="auto" controls autoplay>
                    <source src="img/films/videos/<?php echo $afficheinfofilm["video_films"]; ?>" type=video/ogg>
                        <source src="img/films/videos/<?php echo $afficheinfofilm["video_films"]; ?>" type=video/mp4>
                        </video> </div> </div> <div id="commentaire">
                    <div class="seperationhr">
                        <hr class="style-two">
                        </hr>
                    </div>
                    <div class="ensemblecommentaires">
                        <div class="titrecommentaires"><span>C</span>ommentaires</div>

                        <?php
                    $sqlcommentaire2 = "SELECT * FROM commentaires WHERE id_membres=".$_SESSION["membres"]["id"]." AND id_films=".$_GET["id_film"]."";
                    $requetecommentaire2 = $db->prepare($sqlcommentaire2);
                    $requetecommentaire2->execute();
                    $affichecommentairecount2 = $requetecommentaire2->rowCount();  
                    // $affichenotecount2 = $requetenote->columnCount();  // nombre total de vote 
                    $affichecommentaire2 = $requetecommentaire2->fetch();


                    if (isset($_GET["action"])){
                        if ($_GET["action"] == "commentairea")
                    {
                        $commentaire = $_POST["commentaire"];

                        if ($affichecommentairecount2 >= 1){echo "Vous avez déjà laissé un commentaire pour ce film<br><br>";}
                        
                        if ($affichecommentairecount2 == 0){
                        
                        $sqlfavoris = "INSERT INTO `commentaires`(`commentaires_commentaires`, `date_commentaires`, `id_membres`,  `id_films`) 
                        VALUES (:commentaire, :datecommentaire, :id_membres, :idfilm)";
    
                        $id_membres = $_SESSION["membres"]["id"];
                        $date = time();
    
                        $requetefavoris = $db->prepare($sqlfavoris);
                        $requetefavoris->execute(array(
                            ":commentaire" => $commentaire,
                            ":datecommentaire" =>$date,                            
                            ":id_membres" => $_SESSION["membres"]["id"],
                            ":idfilm" => $_GET["id_film"]
                        ));                        
                    }
                }

                if ($_GET["action"] == "commentairesuppr") 
                {

                    $sqlsupprcommentaire = "DELETE FROM commentaires WHERE id_membres =".$_SESSION["membres"]["id"]." AND id_films=".$_GET["id_film"]."";
                    $requetesupprcommentaire = $db->prepare($sqlsupprcommentaire);
                    $requetesupprcommentaire->execute();
                    $affichesupprcommentaire = $requetesupprcommentaire->fetch();

                    echo "Votre commentaire pour le film est supprimé<br><br>";
                }

                }

                $sqlcommentaire = "SELECT * FROM commentaires WHERE id_membres=".$_SESSION["membres"]["id"]." AND id_films=".$_GET["id_film"]."";
                $requetecommentaire = $db->prepare($sqlcommentaire);
                $requetecommentaire->execute();
                $affichecommentairecount = $requetecommentaire->rowCount();  
                // $affichenotecount2 = $requetenote->columnCount();  // nombre total de vote 
                $affichecommentaire = $requetecommentaire->fetch();


                    if ($affichecommentairecount == 1) { echo "Vous avez deja laissé un commentaire pour ce film";
                        ?>
                    <a href="film.php?id_film=<?php echo $_GET['id_film']; ?>&action=commentairesuppr#favoris">
                    <i class='fa-solid fa-trash-can delete'></i></a>
                        <?php
                        } else  {
                        ?>

                        <div class="divtextarea">
                        <form action="film.php?action=commentairea&id_film=<?php echo $_GET["id_film"]?>#commentaire"
                            method="POST">

                            <textarea cols="100" rows="5" name="commentaire"
                                placeholder="Laissez un commentaire au film (200 caractères max)"
                                maxlength="200"></textarea><br>
                            <input type="submit" value="Je valide mon commentaire">

                        </form>
                        </div>
                        
                            <?php }

                            $sqlcommentairetous = "SELECT * FROM commentaires c, films f, membres m
                            WHERE c.id_membres=m.id_membres and c.id_films=f.id_films
                            AND f.id_films=".$_GET["id_film"]." ORDER BY date_commentaires DESC";
                            $requetecommentairetous = $db->prepare($sqlcommentairetous);
                            $requetecommentairetous->execute();
                            while ($affichecommentairetous = $requetecommentairetous->fetch())
                            {

                            $nom_membres=  substr($affichecommentairetous["nom_membres"], 0, 1); 
                            $date = date("d/m/Y", $affichecommentairetous["date_commentaires"]);

                                ?>
                                <div class="touscommentaires">
                    
                                 <?php echo $affichecommentairetous["prenom_membres"]; echo " "; echo $nom_membres; echo "."; ?> le <?php echo $date;?> : <?php echo $affichecommentairetous["commentaires_commentaires"];?>
                                 </div>
                            <?php }?>

                                   
                    </div>

                    <div class="seperationhr">
                        <hr class="style-two">
                        </hr>
                    </div>



                    <?php include('includes/footer.php'); ?>

                    <!-- <script src="js/javascript.js"></script> -->
                    <script src="js/script.js"></script>
                    <script src="js/navbar.js"></script>

                  
                    
</body>

</html>