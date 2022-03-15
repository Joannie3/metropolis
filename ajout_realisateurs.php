<?php
 // ici on demarre la session PHP
session_start();

require_once "includes/bddconnexion.php";

if (empty($_SESSION["membres"])){ header("Location: index.php");}
else{

$sqladmin = "SELECT * FROM `membres` WHERE id_membres=".$_SESSION["membres"]["id"]."";
$requeteadmin=$db->prepare($sqladmin);
$requeteadmin->execute();
$afficheadmin = $requeteadmin->fetch();

if ($afficheadmin["roles_membres"] == '1'){ 
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

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="css/styleadm.css" rel="stylesheet">
        <title>Metropolis - Gestion realisateurs</title>
    </head>

    <body>
        <div class="container">

            <div class="ajoutfilmbase">
                <h1>Gestion des realisateurs - <a href="administration.php">Retour a l'administration</a></h1>


                <h2>Film sans realisateur : </h2>

<?php

if (isset($_GET["action"]))
{

    if (isset($_GET["film_id"])) {$lien = $_GET["film_id"];}
    else {$lien = $_POST["film_id"];}

    $sqlfilmrealisateur = "SELECT * FROM films WHERE valide_realisateur='0' AND id_films=".$lien."";
    $requetefilmrealisateur=$db->prepare($sqlfilmrealisateur);
    $requetefilmrealisateur->execute();    
    $nombrefilmrealisateur = $requetefilmrealisateur->fetch();


    if ($_GET["action"] == "ajout")
    {
        echo "<h2>".$nombrefilmrealisateur["titre_films"]."</h2>";

      if (isset($_GET["b"]))  
      {
          if ($_GET["b"] == "a")
          {

            $id2 = $_POST["realisateur"];
                    
            // et on pense a l'ajouter dans avoir_acteurs
            $sql2 = "INSERT INTO `avoir_realisateurs`(`id_realisateurs`, `id_films`) VALUES (:idrealisateur, :idfilm)";
            $query2 = $db->prepare($sql2); 
            $query2->execute(array(
                ":idrealisateur" =>  $id2,
                ":idfilm" => $_GET['film_id']
            ));  

            $sql3 = "UPDATE films SET `valide_realisateur`='1' WHERE id_films=:idfilm";
            $query3 = $db->prepare($sql3); 
            // permet de verifier que c'est bien une chaine de caractere
            $query3->bindValue(":idfilm", $_GET['film_id'], PDO::PARAM_INT);
            $query3->execute(array(
                ":idfilm" => $_GET['film_id']
            ));  

            echo "Félicitation le réalisateur est bien ajouté pour le film ";
             echo $nombrefilmrealisateur['titre_films'];
          }
      }

      if (isset($_GET["a"])){
        if ($_GET["a"] == "m") {

            if (isset($_POST["prenom_realisateur"], $_POST["nom_realisateur"], $_POST["datenaissance_realisateur"]) && !empty($_POST['prenom_realisateur']) && !empty($_POST['nom_realisateur']) && !empty($_POST['datenaissance_realisateur']))
            {
                // il faut ajouter l'acteur dans la base acteur
                $prenom = strip_tags($_POST["prenom_realisateur"]);
                $nom = strip_tags($_POST["nom_realisateur"]);
                $datenaissance = $_POST["datenaissance_realisateur"];

            $sql = "INSERT INTO `realisateurs`(`nom_realisateurs`, `prenom_realisateurs`, `datenaissance_realisateurs`) 
            VALUES (:nom, :prenom, :datenaissance)";
            $query = $db->prepare($sql); 
            $query->execute(array(
                ":nom" =>  $prenom,
                ":prenom" => $nom,
                ":datenaissance" => $datenaissance
            ));  

            $id = $db->lastInsertId();

             // et on pense a l'ajouter dans avoir_acteurs
            $sql2 = "INSERT INTO `avoir_realisateurs`(`id_realisateurs`, `id_films`) VALUES (:iddernier, :idfilm)";
            $query2 = $db->prepare($sql2); 
            $query2->execute(array(
                ":iddernier" =>  $id,
                ":idfilm" => $_GET['film_id']
            ));  

            $sql3 = "UPDATE films SET `valide_realisateur`='1' WHERE id_films=:idfilm";
            $query3 = $db->prepare($sql3); 
            // permet de verifier que c'est bien une chaine de caractere
            $query3->bindValue(":idfilm", $_GET['film_id'], PDO::PARAM_INT);
            $query3->execute(array(
                ":idfilm" => $_GET['film_id']
            ));  

                echo "Félictation le réalisateur est ajouté";
            }
            else 
            {
                echo "Merci de remplir tous les champs";
            }

            
                }
                    }

    ?>

                <div class="ligneajout">
                    <div class="ligneajouttitre"> Réalisateurs possible:</div>

                    <div class="ligneajoutform">
                    <form action="ajout_realisateurs.php?action=ajout&b=a&film_id=<?php echo $lien;?>" method="POST">
                        <select name="realisateur" id="realisateur-select">
                           
                                <option value="">--Choisir un réalisateur--</option>
                                <?php
                                    $sqlrealisateur = "SELECT * FROM realisateurs ORDER BY prenom_realisateurs DESC";
                                    $requeterealisateur=$db->prepare($sqlrealisateur);
                                    $requeterealisateur->execute();    

                                while ($afficherealisateur = $requeterealisateur->fetch())
                                {
                                    // ici on verifie si l'acteur est deja dans avoir acteur avec ce film
                                    $sqlrealisateurp = "SELECT COUNT(*) FROM avoir_realisateurs WHERE id_realisateurs=".$afficherealisateur["id_realisateurs"]." AND id_films=".$_POST['film_id']."";
                                    $requeterealisateurp=$db->prepare($sqlrealisateurp);
                                    $requeterealisateurp->execute(); 
                                    $afficherealisateurp = $requeterealisateurp->fetchColumn();

                                    if ($afficherealisateurp >= 1) {}
                                    else {            
                                    ?>
                                <option value="<?php echo $afficherealisateur["id_realisateurs"];?>">
                                    <?php echo $afficherealisateur["prenom_realisateurs"]." ".$afficherealisateur["nom_realisateurs"]; ?>
                                </option>
                                <?php
                                }
                                }
                                ?>
                        </select>
                        <input type="submit" value="Je sélectionne ce(tte) réalisateur(rice)">
                        </form>
                    </div>
                </div> <!-- fin de ma ligne ajout -->

                <hr class="style-two">
                </hr>

                <h2>Ajouter un realisateur manuellement à <?php echo $nombrefilmrealisateur['titre_films'];?></h2>

                <form action="ajout_realisateurs.php?action=ajout&a=m&film_id=<?php echo $lien;?>" method="POST">
            <div class="ligneajout">            
                    <div class="ligneajouttitre"> Prénom du réalisateur</div>

                    <div class="ligneajoutform"><input type="text" name="prenom_realisateur" placeholder="Prénom du réalisateur"></div>
            </div> <!-- fin de ma ligne ajout -->

            <div class="ligneajout">            
                    <div class="ligneajouttitre"> Nom du réalisateur</div>

                    <div class="ligneajoutform"><input type="text" name="nom_realisateur" placeholder="Nom du réalisateur"></div>
            </div> <!-- fin de ma ligne ajout -->

            <div class="ligneajout">            
                    <div class="ligneajouttitre"> Date naissance du réalisateur</div>

                    <div class="ligneajoutform"><input type="date" name="datenaissance_realisateur" ></div>
            </div> <!-- fin de ma ligne ajout -->

            <div class="ligneajout">
                <input type="submit" value="J'ajoute ce(tte) réalisateur(rice)">
            </div> <!-- fin de ma ligne ajout -->
            </form>




       <?php
    }

}



?>
                <hr class="style-two">
                </hr>


<div class="ligneajout">

    <div class="ligneajouttitre"> Film sans realisateur :</div>

    <div class="ligneajoutform">
        <form action="ajout_realisateurs.php?action=ajout" method="POST">

            <select name="film_id" id="film">
                <option value="">--Choisir le film pour ajouter un realisateur--</option>
                <?php 
                // ici je cherche les films qui sont a zero
                $sqlfilmzero = "SELECT * FROM films WHERE valide_realisateur='0'";
                $requetefilmzero=$db->prepare($sqlfilmzero);
                $requetefilmzero->execute();    
                while ($nombrefilmzero = $requetefilmzero->fetch())
                {
                    ?>
                <option value="<?php echo $nombrefilmzero["id_films"];?>">
                    <?php echo $nombrefilmzero["titre_films"];
                    
                }
                ?>
            </select>
            <input type="submit" value="Je modifie ce film sans realisateur">
        </form>
    </div><!-- fin ligne ajout form -->

</div> <!-- fin ligne ajout  -->


                </div> <!-- ajoutfilmbase -->
            </div> <!-- container -->
            <?php
    }
    else{  header("Location: index.php");  }
}
    ?>

</body>

</html>