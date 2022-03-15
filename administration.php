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
            <title>Metropolis - Administration</title>
        </head>

        <body>
            <div class="container">

                <?php
                // ici on met chaque film à un si tt les conditions sont remplies
                $sqlfilmun = "SELECT * FROM films WHERE valide='0' AND valide_acteur='1' AND valide_realisateur='1' AND valide_genres='1'";
                $requetefilmun = $db->prepare($sqlfilmun);
                $requetefilmun->execute();
                while ($nombrefilmun = $requetefilmun->fetch()) {

                    $sql3 = "UPDATE films SET `valide`='1' WHERE id_films=:idfilm";
                    $query3 = $db->prepare($sql3);
                    // permet de verifier que c'est bien une chaine de caractere
                    $query3->bindValue(":idfilm", $nombrefilmun["id_films"], PDO::PARAM_INT);
                    $query3->execute(array(
                        ":idfilm" => $nombrefilmun["id_films"]
                    ));  
                }



                // ici on selectionne les films qui sont à 0
                $sqlfilmzero = "SELECT * FROM films WHERE valide='0'";
                $requetefilmzero = $db->prepare($sqlfilmzero);
                $requetefilmzero->execute();
                $nombrefilmzero = $requetefilmzero->fetch();

                // // // je recupere l'id des films à zero
                // // echo "titre film a zero : ";
                // // echo $nombrefilmzero["titre_films"];
                // // echo "<br>";
                // // echo "<br>";

                $sqlacteurp2 = "SELECT * FROM films WHERE valide_acteur='0'";
                $requeteacteurp2 = $db->prepare($sqlacteurp2);
                $requeteacteurp2->execute();
                $nombreacteurp2 = $requeteacteurp2->fetchAll();

                // var_dump($nombreacteurp2);

                $total = count($nombreacteurp2);


                $sqlrealisateurp2 = "SELECT * FROM films WHERE valide_realisateur='0'";
                $requeterealisateurp2 = $db->prepare($sqlrealisateurp2);
                $requeterealisateurp2->execute();
                $nombrerealisateurp2 = $requeterealisateurp2->fetchAll(PDO::FETCH_ASSOC);

                $total2 = count($nombrerealisateurp2);

                $sqlgenrep2 = "SELECT * FROM films WHERE valide_genres='0'";
                $requetegenrep = $db->prepare($sqlgenrep2);
                $requetegenrep->execute();
                $nombregenrep = $requetegenrep->fetchAll(PDO::FETCH_ASSOC);

                $total3 = count($nombregenrep);

                // // ici je regarde si l'id du film apparait au moins une fois dans la table acteur
                // $sqlacteurp = "SELECT COUNT(*) FROM avoir_acteurs WHERE id_films=".$nombrefilmzero["id_films"]."";
                // $requeteacteurp=$db->prepare($sqlacteurp);
                // $requeteacteurp->execute();
                // $nombreacteurp = $requeteacteurp->fetchColumn();

                // if ($nombreacteurp == '0'){$nombreacteurp2 = 1;} else {$nombreacteurp2 = "0";  }


                // // ici je regarde si l'id du film apparait au moins une fois dans la table acteur
                // $sqlrealisateurp = "SELECT COUNT(*) FROM avoir_realisateur WHERE id_films=".$nombrefilmzero["id_films"]."";
                // $requeterealisateurp=$db->prepare($sqlrealisateurp);
                // $requeterealisateurp->execute();
                // $nombrerealisateurp = $requeterealisateurp->fetchColumn();

                // if ($nombrerealisateurp == '0'){$nombrerealisateurp2 = 1;} else {$nombrerealisateurp2 = "0";  }

                ?>

                <div class="ajoutfilmbase">
                    <h1>Administration</h1>

                    <div class="ligneajout">
                        <a href="ajout_film.php">Ajouter un film </a>&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="edit_film.php"> Editer un film </a>
                    </div>

                    <div class="ligneajout">
                        <a href="ajout_acteurs.php">Ajouter les acteurs d'un film (<?php echo $total; ?>)</a>&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="edit_acteurs.php">Editer un acteur </a>
                    </div>

                    <div class="ligneajout">
                        <a href="ajout_realisateurs.php">Ajouter le realisateur d'un film (<?php echo $total2; ?>)</a> &nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="edit_realisateurs.php">Editer un realisateur</a>
                    </div>

                    <div class="ligneajout">
                        <a href="ajout_genres.php">Ajouter les genres d'un film (<?php echo $total3; ?>)</a> &nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="edit_genres.php">Editer les genres d'un film</a>
                    </div>


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

        </body>

        </html>