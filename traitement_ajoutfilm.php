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
            <title>Metropolis - Ajout d'un film</title>
        </head>

        <body>
            <div class="container">

                <div class="ajoutfilmbase">
                    <h1>Ajouter un film - <a href="administration.php">Retour a l'administration</a> </h1>

                    <?php
                    require_once "includes/bddconnexion.php";


                    if (!empty($_POST)) {

                        // ici on verrifie que tous les champs soit bien remplis et non vide
                        if (
                            isset($_POST["titre"], $_POST["duree"], $_POST["datesortie"], $_POST["pegi"], $_POST["synopsis"], $_POST["affiche"], $_POST["video"])
                            && !empty($_POST["titre"])  && !empty($_POST["duree"])  && !empty($_POST["datesortie"])  && !empty($_POST["pegi"]) && !empty($_POST["synopsis"]) && !empty($_POST["affiche"]) && !empty($_POST["video"])
                        ) {


                            //strip_tags permet de supprimer les balises html qui pourrait y avoir dans la saisie des differents champs
                            $titrefilm = strip_tags($_POST["titre"]);
                            $dureefilm = $_POST["duree"];
                            $datesortiefilm = $_POST["datesortie"];
                            $pegifilm = strip_tags($_POST["pegi"]);
                            $synopsisfilm = strip_tags($_POST["synopsis"]);
                            $affichefilm = $_POST["affiche"];
                            $videofilm = $_POST["video"];


                            $sql = "INSERT INTO `films`(`titre_films`, `synopsis_films`, `duree_films`, `datesortie_films`, `pegi_films`, `affiche_films`, `affiche2_films`, `video_films`, `valide`) VALUES (:titre, :synopsis, :dureefilm, :datesortie, :pegi, :affiche, :affiche2, :video, '0')";

                            $query = $db->prepare($sql);
                            $query->execute(array(
                                ":titre" => $titrefilm,
                                ":synopsis" => $synopsisfilm,
                                ":dureefilm" => $dureefilm,
                                ":datesortie" => $datesortiefilm,
                                ":pegi" => $pegifilm,
                                ":affiche" => $affichefilm,
                                ":affiche2" => $affichefilm,
                                ":video" => $videofilm
                            ));

                            echo "<br>Merci d'avoir completer le formulaire, le film est bien ajouté";
                        }
                    } else {
                        echo "Merci de completer tout les champs du formulaire";
                    }
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