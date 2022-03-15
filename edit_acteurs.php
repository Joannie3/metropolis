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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto:wght@300&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="css/styleadm.css" rel="stylesheet">
    <title>Metropolis - Edition film</title>
</head>

<body>
    <div class="container">
        <div class="ajoutfilmbase">

            <h1>Editer un acteur - <a href="administration.php">Retour a l'administration</a></h1>

<?php 

if(isset($_GET["action"]))
{

    if ($_GET["action"] == 'editer2')
    {
        $idacteur = $_GET["acteur_id"];

            // il faut ajouter l'acteur dans la base acteur
            $prenom = strip_tags($_POST["prenom_acteur"]);
            $nom = strip_tags($_POST["nom_acteur"]);
            $datenaissance = $_POST["datenaissance_acteur"];
            $photo = strip_tags($_POST["photo_acteur"]);

            $sql3 = "UPDATE acteurs SET nom_acteurs = :nom, prenom_acteurs = :prenom, datenaissance_acteurs= :datenaissance, photo_acteurs = :photo WHERE id_acteurs=".$idacteur."";
            $requete3 = $db->prepare($sql3);
            $requete3->execute(array(
            ":nom" => $nom,
            ":prenom" => $prenom,
            ":datenaissance" => $datenaissance,
            ":photo" => $photo
        ));

        $sqlacteurc2 = "SELECT * FROM acteurs WHERE id_acteurs=".$idacteur."";
        $requeteacteurc2=$db->prepare($sqlacteurc2);
        $requeteacteurc2->execute();    
        $nombreacteurc2 = $requeteacteurc2->fetch();

echo "Félicitation ";
echo $nombreacteurc2["prenom_acteurs"]; 
echo " "; 
echo $nombreacteurc2["nom_acteurs"]; 
echo " est modifié";

    }


    if ($_GET["action"] == 'editer')
    {

        $sqlacteurc = "SELECT * FROM acteurs WHERE id_acteurs=".$_POST["acteur_id"]."";
        $requeteacteurc=$db->prepare($sqlacteurc);
        $requeteacteurc->execute();    
        $nombreacteurc = $requeteacteurc->fetch();
?>

<form action="edit_acteurs.php?action=editer2&acteur_id=<?php echo $_POST["acteur_id"];?>" method="POST">
            <div class="ligneajout">            
                    <div class="ligneajouttitre"> Prénom de l'acteur</div>

                    <div class="ligneajoutform"><input type="text" name="prenom_acteur" value="<?php echo $nombreacteurc["prenom_acteurs"]?>"></div>
            </div> <!-- fin de ma ligne ajout -->

            <div class="ligneajout">            
                    <div class="ligneajouttitre"> Nom de l'acteur</div>

                    <div class="ligneajoutform"><input type="text" name="nom_acteur" value="<?php echo $nombreacteurc["nom_acteurs"]?>"></div>
            </div> <!-- fin de ma ligne ajout -->

            <div class="ligneajout">            
                    <div class="ligneajouttitre"> Date naissance de l'acteur</div>

                    <div class="ligneajoutform"><input type="date" name="datenaissance_acteur" value="<?php echo $nombreacteurc["datenaissance_acteurs"]?>"></div>
            </div> <!-- fin de ma ligne ajout -->

            <div class="ligneajout">            
                    <div class="ligneajouttitre"> Lien de la photo de l'acteur</div>

                    <div class="ligneajoutform"><input type="text" name="photo_acteur" value="<?php echo $nombreacteurc["photo_acteurs"]?>"></div>
            </div> <!-- fin de ma ligne ajout -->

            <div class="ligneajout">
                <input type="submit" value="Je modifie la fiche de cet(te) acteur(rice)">
            </div> <!-- fin de ma ligne ajout -->
            </form>

            <hr class="style-two">
                </hr>

<?php
    }
}
 ?>


            

            <div class="ligneajout">

                <form action="edit_acteurs.php?action=editer" method="POST">
                    Choisir l'acteur à éditer:
                    <select name="acteur_id" id="acteur_id">
                        <option value="">--Choisir l'acteur à modifier--</option>

                        <?php 

$sqlacteurs = "SELECT * FROM acteurs ORDER BY nom_acteurs ASC";
$requeteacteurs=$db->prepare($sqlacteurs);
$requeteacteurs->execute();    
while ($afficheacteurs = $requeteacteurs->fetch())
{
    ?>
                        <option value="<?php echo $afficheacteurs["id_acteurs"];?>">
                            <?php echo $afficheacteurs["nom_acteurs"]; echo " "; echo $afficheacteurs["prenom_acteurs"];
}

?>
                    </select>
                    <input type="submit" value="J'édite cet acteur">
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