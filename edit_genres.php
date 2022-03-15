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
            <title>Metropolis - Edition film</title>
        </head>

        <body>
            <div class="container">
                <div class="ajoutfilmbase">

                    <h1>Editer un film - <a href="administration.php">Retour a l'administration</a></h1>

                    <?php

                    


                    if (isset($_GET["action"])) {

                        if (isset($_GET["film_id"])) {
                            $lien = $_GET["film_id"];
                        } else {
                            $lien = $_POST["film_id"];
                        }
                        
                        $sqlgenrezero = "SELECT * FROM films WHERE id_films=".$lien."";
                        $requetegenrezero=$db->prepare($sqlgenrezero);
                        $requetegenrezero->execute();    
                        $nombregenrezero = $requetegenrezero->fetch();

                        if ($_GET["action"] == 'editer') {




                            $sqlfilmc = "SELECT * FROM films WHERE id_films=" . $lien . "";
                            $requetefilmc = $db->prepare($sqlfilmc);
                            $requetefilmc->execute();
                            $nombrefilmc2 = $requetefilmc->fetch();

                            if (isset($_GET["a"])) {
                                if ($_GET["a"] == 'b') {

                                    $idfilm = $_GET["film_id"];

                                    // ici on supprime tt les genres du films et en dessous on traite l'info
                                    $sql = "DELETE FROM avoir_genres WHERE id_films=" . $_GET['film_id'] . "";
                                    $requete = $db->prepare($sql);
                                    $requete->execute();

                                    foreach ($_POST["genres"] as $genres) {

                                        if ($genres == '1') {
                                            //echo "action coché";
                                            $sql1 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES (:genres, :idfilm)";
                                            $query1 = $db->prepare($sql1);
                                            $query1->execute(array(
                                                ":genres" => $genres,
                                                ":idfilm" => $_GET['film_id']
                                            ));
                                        }
                                        if ($genres == '2') {
                                            // echo "aventure coché";
                                            $sql2 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES  (:genres, :idfilm)";
                                            $query2 = $db->prepare($sql2);
                                            $query2->execute(array(
                                                ":genres" => $genres,
                                                ":idfilm" => $_GET['film_id']
                                            ));
                                        }
                                        if ($genres == '3') {
                                            // echo "comedie coché";
                                            $sql3 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES  (:genres, :idfilm)";
                                            $query3 = $db->prepare($sql3);
                                            $query3->execute(array(
                                                ":genres" => $genres,
                                                ":idfilm" => $_GET['film_id']
                                            ));
                                        }
                                        if ($genres == '4') {
                                            // echo "drame coché";
                                            $sql4 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES  (:genres, :idfilm)";
                                            $query4 = $db->prepare($sql4);
                                            $query4->execute(array(
                                                ":genres" => $genres,
                                                ":idfilm" => $_GET['film_id']
                                            ));
                                        }
                                        if ($genres == '5') {
                                            // echo "fantastique coché";
                                            $sql5 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES  (:genres, :idfilm)";
                                            $query5 = $db->prepare($sql5);
                                            $query5->execute(array(
                                                ":genres" => $genres,
                                                ":idfilm" => $_GET['film_id']
                                            ));
                                        }
                                        if ($genres == '6') {
                                            // echo "guerre coché";
                                            $sql6 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES  (:genres, :idfilm)";
                                            $query6 = $db->prepare($sql6);
                                            $query6->execute(array(
                                                ":genres" => $genres,
                                                ":idfilm" => $_GET['film_id']
                                            ));
                                        }
                                        if ($genres == '7') {
                                            // echo "policier coché";
                                            $sql7 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES  (:genres, :idfilm)";
                                            $query7 = $db->prepare($sql7);
                                            $query7->execute(array(
                                                ":genres" => $genres,
                                                ":idfilm" => $_GET['film_id']
                                            ));
                                        }
                                        if ($genres == '8') {
                                            // echo "horreur coché";
                                            $sql8 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES  (:genres, :idfilm)";
                                            $query8 = $db->prepare($sql8);
                                            $query8->execute(array(
                                                ":genres" => $genres,
                                                ":idfilm" => $_GET['film_id']
                                            ));
                                        }
                                        if ($genres == '9') {
                                            // echo "western coché";
                                            $sql9 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES  (:genres, :idfilm)";
                                            $query9 = $db->prepare($sql9);
                                            $query9->execute(array(
                                                ":genres" => $genres,
                                                ":idfilm" => $_GET['film_id']
                                            ));
                                        }
                                        if ($genres == '10') {
                                            // echo "SF coché";
                                            $sql10 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES  (:genres, :idfilm)";
                                            $query10 = $db->prepare($sql10);
                                            $query10->execute(array(
                                                ":genres" => $genres,
                                                ":idfilm" => $_GET['film_id']
                                            ));
                                        }
                                    }
                                    echo "Les genres du film ";
                                    echo  $nombregenrezero["titre_films"];
                                    echo " sont mis à jour";

                                }
                            }

                    ?>

                            <div class="basegenres">
<?php


echo "<h1>";
echo $nombregenrezero["titre_films"];
echo "</h1>";

?>


                                <form action="edit_genres.php?action=editer&a=b&film_id=<?php echo $lien; ?>" method="POST">
                                    <?php
                                    $sqlfilm = "SELECT * FROM genres ";
                                    $requetefilm = $db->prepare($sqlfilm);
                                    $requetefilm->execute();
                                    // $count = $requetefilm->rowCount();  
                                    while ($affichefilm = $requetefilm->fetch()) {

                                        $sqlfilm2 = "SELECT * FROM avoir_genres WHERE id_genres=" . $affichefilm["id_genres"] . " AND id_films=" . $lien . "";
                                        $requetefilm2 = $db->prepare($sqlfilm2);
                                        $requetefilm2->execute();
                                        $count = $requetefilm2->rowCount();

                                        // echo $affichefilm["genre_genres"]; echo $count;
                                        // echo "<br>";

                                        if ($count == '1') {

                                    ?>
                                            <div class="check1">
                                                <input type="checkbox" name="genres[]" value="<?php echo $affichefilm["id_genres"]; ?>" checked><?php echo $affichefilm["genre_genres"]; ?>
                                            </div>
                                        <?php


                                        } else {

                                        ?>
                                            <div class="check1">
                                                <input type="checkbox" name="genres[]" value="<?php echo $affichefilm["id_genres"]; ?>"><?php echo $affichefilm["genre_genres"]; ?>
                                            </div>
                                    <?php


                                        }
                                    }

                                    ?>

                            <div class="ligneajout">
                            <input type="submit" value="Je modifie les genres du film">
                            </div> <!-- fin de ma ligne ajout -->

                                </form>
                            </div>

                            <hr class="style-two"></hr>

                    <?php
                        }
                    }
                    ?>
                    <div class="ligneajout">

                        <form action="edit_genres.php?action=editer" method="POST">
                            Choisir le film ou il faut modifier les genres :
                            <select name="film_id" id="film">
                                <option value="">--Choisir le film à modifier--</option>

                                <?php
                                $sqlfilm = "SELECT * FROM films ";
                                $requetefilm = $db->prepare($sqlfilm);
                                $requetefilm->execute();
                                while ($affichefilm = $requetefilm->fetch()) {
                                ?>
                                    <option value="<?php echo $affichefilm["id_films"]; ?>">
                                    <?php echo $affichefilm["titre_films"];
                                }

                                    ?>
                            </select>
                            <input type="submit" value="J'édite ce film">
                        </form>

                    </div>
                </div> <!-- ajout film base -->
            </div> <!-- container -->
    <?php
    } // role membres
    else {
        header("Location: index.php");
    }
}
    ?>
        </body>

        </html>