
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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto:wght@300&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="css/style.css" rel="stylesheet">
    <title>Metropolis - Inscription</title>
</head>

<body>


    <div class="container">

        <div class="inscription">

            <div class="inscriptionimageg"><img src="img/inscription/logoinscription.png"></div>

            <div class="inscriptionformulaire1">

                <div class="inscriptionensemble">

                    <div class="titreinscription"> <span>T</span>raitement <span>I</span>nscription</div>

                    <hr class="style-two">
                </hr>

                    
                <?php 

// on verifier que les elements POST ne sont pas vides.
        if (!empty($_POST)){ // ici on fait le traitement de l'inscription

            // ici on verrifie que tous les champs soit bien remplis et non vide
            if (isset($_POST["civilite"], $_POST["nom"], $_POST["prenom"], $_POST["password"], $_POST["email"])
                && !empty($_POST["civilite"])  && !empty($_POST["nom"])  && !empty($_POST["prenom"])  && !empty($_POST["password"]) && !empty($_POST["email"]))
            {

                // ici mon formulaire est complet
                // on recupere les donnees et on les protegent

                //strip_tags permet de supprimer les balises html qui pourrait y avoir dans la saisie des differents champs
                $civilite = strip_tags($_POST["civilite"]);
                $nom = strip_tags($_POST["nom"]);
                $prenom = strip_tags($_POST["prenom"]);

                // ici on verifie que l'email est un vrai email
                // si le post email ne contient pas un email alors on fait un die
                if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
                {
                    echo "L'adresse e-mail est incorrect";
                }
               
                // a partir de la je sais que c'est un email

                // ici on s'occupe du mot de pass et le chiffre
                $password = password_hash($_POST["password"], PASSWORD_ARGON2ID);

                // on enregistre dans la base de données.
                require_once "includes/bddconnexion.php";

                // ici il faut verifier que l'adresse mail est unique 

                $sqlrecherche = "SELECT * FROM membres WHERE email_membres=:email";
                $queryrecherche = $db->prepare($sqlrecherche);
                $queryrecherche->execute(array(
                    ":email" => $_POST["email"]
                ));  

                $count = $queryrecherche->rowCount();

                if ($count == '1') {echo "Désolé mais l'adresse mail inscris est déjà utilsé";}
                if ($count == '0') {

                $sql = "INSERT INTO `membres`(`civilite_membres`, `nom_membres`, `prenom_membres`, `email_membres`, `password_membres`, `forfait_membres`,`roles_membres`) VALUES (:civilite, :nom, :prenom, :email, :pass, 'forfait4ecrans', '3')";

                $query = $db->prepare($sql); 
                $query->execute(array(
                    ":civilite" =>  $civilite,
                    ":nom" =>  $nom,
                    ":prenom" =>  $prenom,
                    ":email" =>  $_POST["email"],
                    ":pass" =>  $password
                ));  

                // ici il faut recuperer l'id du membres
                $id = $db->lastInsertId();
                // lastInsertId permet de recuperer le dernier ID qu'on a inserer dans la bdd


                echo "Félicitation, votre inscription est validé";

                // ici on connecte l'utilisateur

                               
                               // on va stocker dans $_SESSION les infos de l'utilisateur   
                               // ici je stock l'id du membre dans ID on met membres dans session et du coup on va cherche $membres['id_membres'] de la BDD                          
                               $_SESSION["membres"] = [
                                "id" => $id,
                                "nom" => $nom,
                                "prenom" => $prenom,
                                "email" => $_POST["email"]
                                ];
                               
                               // si on veut recuperer les infos il faut faire session_start à chaque fois

                               //ici le membre est connecté du coup on le redirige vers la page film connecte.php
                               header("Location: listefilm.php");
               

            }
        }
            else{
                echo"Le formulaire est incomplet";
            }


        }
        else {
            echo "Vous devez remplir tous les champs.";
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