<?php
// ici on demarre la session PHP
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <title>Metropolis - Inscription</title>
</head>

<body>


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
        <link href="css/style.css" rel="stylesheet">
        <title>Metropolis - Inscription</title>
    </head>

    <body>


        <div class="container">

            <div class="inscription">

                <div class="inscriptionimageg"><img src="img/inscription/logoinscription.png"></div>

                <div class="inscriptionformulaire1">

                    <div class="inscriptionensemble">

                        <div class="titreinscription"> <span>C</span>onnexion</div>

                        <hr class="style-two">
                        </hr>


                        <?php

                        // on verifie que le formulaire n'est pas vide
                        if (!empty($_POST)) {

                            // il faut le mail et pass soit present tt les deux
                            if (isset($_POST["email"], $_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])) 
                            {

                                // deja on verifie que l'email est bien un email
                                if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                                    // si ce n'est pas un email on bloque
                                    die("Ce n'est pas un email");
                                }

                                // on verifie que l'adresse mail existe dans la bdd
                                require_once "includes/bddconnexion.php";
                                $sql = "SELECT * FROM membres WHERE email_membres=:email";
                                $query = $db->prepare($sql);
                                $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
                                $query->execute();
                                $membres = $query->fetch();

                                if (!$membres) { // !$membres = si il n'y a pas de membres alors il existe pas
                                    // on dit email et pass incorrect pour ne pas donner d'indice si un mail existe
                                    die("Désolé cette adresse mail et/ou le mot de pass n'existe pas");
                                }

                                // ici si l'utilisateur existe alors on verifie son mot de pass
                                if (!password_verify($_POST["password"], $membres["password_membres"])) {
                                    die("Désolé cette adresse mail et/ou le mot de pass n'existe pas");
                                }

                                // ici l'utilisateur et le mot de pas sont corrects
                                //  ici on connecte l'utilisateur on ouvre la session elle reste disponible tant qu'on ne ferme pas le navigateur
                                // on va stocker dans $_SESSION les infos de l'utilisateur   
                                // ici je stock l'id du membre dans ID on met membres dans session et du coup on va cherche $membres['id_membres'] de la BDD                          
                                //  info de gauche celle que l'on cree et info de droite celle de la bdd

                                $_SESSION["membres"] = [
                                    "id" => $membres["id_membres"],
                                    "nom" => $membres["nom_membres"],
                                    "prenom" => $membres["prenom_membres"],
                                    "email" => $membres["email_membres"]
                                ];

                                // si on veut recuperer les infos il faut faire session_start à chaque fois
                                //ici le membre est connecté du coup on le redirige vers la page film listefilm.php                               

                                echo "Félicitation vous êtes connecté.<br><br>";
                                // header("Location: listefilm.php");

                                ?>

                                    <meta http-equiv="refresh" content="4; url=listefilm.php"> Vous allez être redirigé


                                <?php

                                // var_dump($_SESSION);
                            }
                        }

                        ?>

                    </div> <!-- inscription ensemble -->


                </div><!-- inscription formulaire 1 -->

            </div><!-- continscriptionainer -->

        </div> <!-- container -->




    </body>

    </html>

</body>

</html>