<?php
// ici on demarre la session PHP
session_start();

require_once "includes/bddconnexion.php";

if (empty($_SESSION["membres"])) {
    header("Location: index.php");
} else {

    $sqladmin = "SELECT * FROM `membres` WHERE id_membres=" . $_SESSION["membres"]["id"] . "";
    $requeteadmin = $db->prepare($sqladmin);
    $requeteadmin->execute();
    $afficheadmin = $requeteadmin->fetch();

    if ($afficheadmin["roles_membres"] == '1') {

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet">

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link href="css/styleadm.css" rel="stylesheet">
            <title>Metropolis - Gestion acteurs</title>
        </head>

        <body>
            <div class="container">

                <div class="ajoutfilmbase">
                    <h1>Gestion des acteurs - <a href="administration.php">Retour a l'administration</a></h1>

                    <?php
                    if (empty($_GET)) {
                    ?>

                        <h2>Film sans acteurs : </h2>

                        <div class="ligneajout">

                            <div class="ligneajouttitre"> Film sans acteur :</div>

                            <div class="ligneajoutform">
                                <form action="ajout_acteurs.php?action=ajout" method="POST">

                                    <select name="film_id" id="film">
                                        <option value="">--Choisir le film pour ajouter un acteur--</option>
                                        <?php
                                        // ici je cherche les films qui sont a zero
                                        $sqlfilmzero = "SELECT * FROM films WHERE valide_acteur='0'";
                                        $requetefilmzero = $db->prepare($sqlfilmzero);
                                        $requetefilmzero->execute();
                                        while ($nombrefilmzero = $requetefilmzero->fetch()) {
                                        ?>
                                            <option value="<?php echo $nombrefilmzero["id_films"]; ?>">
                                            <?php echo $nombrefilmzero["titre_films"];
                                        }
                                            ?>
                                    </select>
                                    <input type="submit" value="Je modifie ce film sans acteur">
                                </form>
                            </div><!-- fin ligne ajout form -->

                        </div> <!-- fin ligne ajout  -->

                        <h2>Film <span>avec</span> acteurs : </h2>

                        <div class="ligneajout">

                            <div class="ligneajouttitre"> Film avec acteurs :</div>

                            <div class="ligneajoutform">
                                <form action="ajout_acteurs.php?action=ajout" method="POST">

                                    <select name="film_id" id="film">
                                        <option value="">--Choisir le film pour ajouter un acteur--</option>
                                        <?php
                                        // ici je cherche les films qui sont a zero
                                        $sqlfilmun = "SELECT * FROM films WHERE valide_acteur='1'";
                                        $requetefilmun = $db->prepare($sqlfilmun);
                                        $requetefilmun->execute();
                                        while ($nombrefilmun = $requetefilmun->fetch()) {
                                        ?>
                                            <option value="<?php echo $nombrefilmun["id_films"]; ?>">
                                                <?php echo $nombrefilmun["titre_films"]; ?>
                                            <?php
                                        }
                                            ?>
                                    </select>
                                    <input type="submit" value="Je modifie ce film avec acteur(s)">
                                </form>
                            </div><!-- fin ligne ajout form -->

                        </div> <!-- fin ligne ajout  -->

                    <?php
                    } // ici on supprimer le choix de la modif si on edite un film
                    ?>
                    <hr class="style-two">
                    </hr>

                    <?php


                    if (isset($_GET["action"])) {
                        if (isset($_GET["film_id"])) {
                            $lien = $_GET["film_id"];
                        } else {
                            $lien = $_POST["film_id"];
                        }

                        if ($_GET["action"] == "ajout") {

                            if (isset($_GET["film_id"])) {
                                $sqlfilmmodif = "SELECT * FROM films WHERE id_films=" . $_GET["film_id"] . "";
                            } else {
                                $sqlfilmmodif = "SELECT * FROM films WHERE id_films=" . $_POST["film_id"] . "";
                            }

                            // $sqlfilmmodif = "SELECT * FROM films WHERE id_films=".$_POST["film_id"]."";
                            $requetefilmmodif = $db->prepare($sqlfilmmodif);
                            $requetefilmmodif->execute();
                            $affichefilmmodif = $requetefilmmodif->fetch();

                            echo "<h1>";
                            echo $affichefilmmodif["titre_films"] . "<br>";
                    ?>
                            <a href="ajout_acteurs.php">(Retour à la gestion des acteurs)</a>
                            <?php
                            echo "</h1>";

                            if (isset($_GET["b"])) {
                                if ($_GET["b"] == "a") {

                                    $id2 = $_POST["acteurs"];

                                    // et on pense a l'ajouter dans avoir_acteurs
                                    $sql2 = "INSERT INTO `avoir_acteurs`(`id_acteurs`, `id_films`) VALUES (:idacteur, :idfilm)";
                                    $query2 = $db->prepare($sql2);
                                    $query2->execute(array(
                                        ":idacteur" =>  $id2,
                                        ":idfilm" => $_GET['film_id']
                                    ));  

                                    $sql3 = "UPDATE films SET `valide_acteur`='1' WHERE id_films=:idfilm";
                                    $query3 = $db->prepare($sql3);
                                    $query3->execute(array(
                                        ":idfilm" => $_GET['film_id']
                                    ));  

                                    echo "Félicitation l'acteur est bien ajouté pour le film ";
                                    echo $affichefilmmodif['titre_films'];
                                }
                            }


                            if (isset($_GET["a"])) {

                                if ($_GET["a"] == "m") {

                                    if (isset($_POST["prenom_acteur"], $_POST["nom_acteur"], $_POST["datenaissance_acteur"], $_POST["photo_acteur"]) && !empty($_POST['prenom_acteur']) && !empty($_POST['nom_acteur']) && !empty($_POST['datenaissance_acteur']) && !empty($_POST['photo_acteur'])) {
                                        // il faut ajouter l'acteur dans la base acteur
                                        $prenom = strip_tags($_POST["prenom_acteur"]);
                                        $nom = strip_tags($_POST["nom_acteur"]);
                                        $datenaissance = $_POST["datenaissance_acteur"];
                                        $photo = strip_tags($_POST["photo_acteur"]);


                                        $sql = "INSERT INTO `acteurs`(`nom_acteurs`, `prenom_acteurs`, `datenaissance_acteurs`, `photo_acteurs`) 
                                        VALUES (:nom, :prenom, :datenaissance, :photo)";
                                        $query = $db->prepare($sql);
                                        $query->execute(array(
                                            ":nom" =>  $nom,
                                            ":prenom" =>  $prenom,
                                            ":datenaissance" => $datenaissance,
                                            ":photo" =>  $photo,
                                        ));  

                                        $id = $db->lastInsertId();

                                        // et on pense a l'ajouter dans avoir_acteurs
                                        $sql2 = "INSERT INTO `avoir_acteurs`(`id_acteurs`, `id_films`) VALUES (:dernierid, :idfilm)";
                                        $query2 = $db->prepare($sql2);
                                        $query2->execute(array(
                                            ":dernierid" =>  $id,
                                            ":idfilm" => $_GET['film_id']
                                        ));  

                                        $sql3 = "UPDATE films SET `valide_acteur`='1' WHERE id_films=:idfilm";
                                        $query3 = $db->prepare($sql3);
                                        $query3->execute(array(
                                            ":idfilm" => $_GET['film_id']
                                        ));  

                                        echo "Félictation l'acteur est ajouté<br>";
                                    } else {
                                        echo "Merci de remplir tous les champs<br>";
                                    }
                                }
                            }

                            if (isset($_GET["film_id"])) {
                                $lien = $_GET["film_id"];
                            } else {
                                $lien = $_POST["film_id"];
                            }

                            ?>

                            <div class="ligneajout">
                                <div class="ligneajouttitre"> Acteur possible:</div>

                                <div class="ligneajoutform">
                                    <form action="ajout_acteurs.php?action=ajout&b=a&film_id=<?php echo $lien; ?>" method="POST">
                                        <select name="acteurs" id="acteurs-select">

                                            <option value="">--Choisir un acteur--</option>
                                            <?php
                                            $sqlacteur = "SELECT * FROM acteurs ORDER BY prenom_acteurs DESC";
                                            $requeteacteur = $db->prepare($sqlacteur);
                                            $requeteacteur->execute();

                                            while ($afficheacteur = $requeteacteur->fetch()) {
                                                // ici on verifie si l'acteur est deja dans avoir acteur avec ce film
                                                $sqlacteurp = "SELECT COUNT(*) FROM avoir_acteurs WHERE id_acteurs=" . $afficheacteur["id_acteurs"] . " AND id_films=".$lien."";
                                                $requeteacteurp = $db->prepare($sqlacteurp);
                                                $requeteacteurp->execute();
                                                $afficheacteurp = $requeteacteurp->fetchColumn();

                                                if ($afficheacteurp >= 1) {
                                                } else {

                                            ?>

                                                    <option value="<?php echo $afficheacteur["id_acteurs"]; ?>">
                                                        <?php echo $afficheacteur["prenom_acteurs"] . " " . $afficheacteur["nom_acteurs"]; ?>
                                                    </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                </div>
                            </div> <!-- fin de ma ligne ajout -->

                            <div class="ligneajout2">
                                <input type="submit" value="Je sélectionne cet(te) acteur(rice)">
                            </div>
                            </form>


                            <hr class="style-two">
                            </hr>

                            <h2>Ajouter un acteur manuellement</h2>
                            <form action="ajout_acteurs.php?action=ajout&a=m&film_id=<?php echo $lien; ?>" method="POST">
                                <div class="ligneajout">
                                    <div class="ligneajouttitre"> Prénom de l'acteur</div>

                                    <div class="ligneajoutform"><input type="text" name="prenom_acteur" placeholder="Prénom de l'acteur"></div>
                                </div> <!-- fin de ma ligne ajout -->

                                <div class="ligneajout">
                                    <div class="ligneajouttitre"> Nom de l'acteur</div>

                                    <div class="ligneajoutform"><input type="text" name="nom_acteur" placeholder="Nom de l'acteur">
                                    </div>
                                </div> <!-- fin de ma ligne ajout -->

                                <div class="ligneajout">
                                    <div class="ligneajouttitre"> Date naissance de l'acteur</div>

                                    <div class="ligneajoutform"><input type="date" name="datenaissance_acteur"></div>
                                </div> <!-- fin de ma ligne ajout -->

                                <div class="ligneajout">
                                    <div class="ligneajouttitre"> Lien de la photo de l'acteur</div>

                                    <div class="ligneajoutform"><input type="text" name="photo_acteur" placeholder="Nom de la photo">
                                    </div>
                                </div> <!-- fin de ma ligne ajout -->

                                <div class="ligneajout">
                                    <input type="submit" value="J'ajoute cet(te) acteur(rice)">
                                </div> <!-- fin de ma ligne ajout -->
                            </form>
                            <hr class="style-two">
                            </hr>

                            <div class="ligneajout2">
                                <h1>Acteur dans le film</h1>

                                <?php

                                if (isset($_GET["film_id"])) {
                                    $lien = $_GET["film_id"];
                                } else {
                                    $lien = $_POST["film_id"];
                                }

                                if (isset($_GET["suppr"])) {
                                    if ($_GET["suppr"] == "acteurs") {



                                        $sqlinfofilm = "SELECT * FROM avoir_acteurs aa, acteurs a, films f 
                                        WHERE aa.id_acteurs = a.id_acteurs and aa.id_films = f.id_films and f.id_films=" . $_GET["film_id"] . "";
                                        $requeteinfofilm = $db->prepare($sqlinfofilm);
                                        $requeteinfofilm->execute();
                                        $afficheinfofilm = $requeteinfofilm->fetch();

                                        $sqlsuppracteur = "DELETE FROM avoir_acteurs WHERE id_acteurs =" . $_GET["id_acteur"] . " AND id_films=" . $_GET["film_id"] . "";
                                        $requetesuppracteur = $db->prepare($sqlsuppracteur);
                                        $requetesuppracteur->execute();
                                        $affichesuppracteur = $requetesuppracteur->fetch();


                                        echo "L'acteur ";
                                        echo $afficheinfofilm["prenom_acteurs"];
                                        echo " ";
                                        echo $afficheinfofilm["nom_acteurs"];
                                        echo " est bien supprimé du film ";
                                        echo $afficheinfofilm["titre_films"];
                                    }
                                }
                                ?>


                                <div class="listeacteur" id="listeacteur">
                                    <?php

                                    $sqllisteacteurs = "SELECT * FROM avoir_acteurs WHERE id_films=" . $lien . "";
                                    $requetelisteacteurs = $db->prepare($sqllisteacteurs);
                                    $requetelisteacteurs->execute();
                                    while ($affichelisteacteurs = $requetelisteacteurs->fetch()) {
                                        $sqllisteacteursa = "SELECT * FROM acteurs WHERE id_acteurs=" . $affichelisteacteurs['id_acteurs'] . "";
                                        $requetelisteacteursa = $db->prepare($sqllisteacteursa);
                                        $requetelisteacteursa->execute();
                                        while ($affichelisteacteursa = $requetelisteacteursa->fetch()) {
                                            echo $affichelisteacteursa['prenom_acteurs'] . " " . $affichelisteacteursa['nom_acteurs'] . " ";
                                    ?>
                                            <a href="ajout_acteurs.php?action=ajout&suppr=acteurs&id_acteur=<?php echo $affichelisteacteursa['id_acteurs']; ?>&film_id=<?php echo $lien; ?>#listeacteur">
                                                <i class='fa-solid fa-trash-can'></i></a>
                                    <?php
                                            echo "<br>";
                                        }
                                    }

                                    ?>
                                </div>
                            </div>




                    <?php


                        }
                    } // fin du isset action

                    ?>
                </div>
            </div> <!-- container -->

    <?php
    } else {
        header("Location: index.php");
    }
}

    ?>

        </body>

        </html>