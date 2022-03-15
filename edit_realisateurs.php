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

        $idrealisateur = $_GET["realisateur_id"];


           

            // il faut ajouter l'acteur dans la base acteur
                $prenom = strip_tags($_POST["prenom_realisateur"]);
                $nom = strip_tags($_POST["nom_realisateur"]);
                $datenaissance = $_POST["datenaissance_realisateur"];

            $sql3 = "UPDATE realisateurs SET nom_realisateurs = :nom, prenom_realisateurs = :prenom, datenaissance_realisateurs= :datenaissance WHERE id_realisateurs=".$idrealisateur."";
            $requete3 = $db->prepare($sql3);
            $requete3->execute(array(
            ":nom" => $nom,
            ":prenom" => $prenom,
            ":datenaissance" => $datenaissance,
        ));


        $sqlrealisateurc2 = "SELECT * FROM realisateurs WHERE id_realisateurs=".$idrealisateur."";
        $requeterealisateurc2=$db->prepare($sqlrealisateurc2);
        $requeterealisateurc2->execute();    
        $nombrerealisateur2 = $requeterealisateurc2->fetch();

echo "Félicitation ";
echo $nombrerealisateur2["prenom_realisateurs"]; 
echo " "; 
echo $nombrerealisateur2["nom_realisateurs"]; 
echo " est modifié";

    }


    if ($_GET["action"] == 'editer')
    {
        $sqlrealisateurc = "SELECT * FROM realisateurs WHERE id_realisateurs=".$_POST["realisateur_id"]."";
        $requeterealisateurc=$db->prepare($sqlrealisateurc);
        $requeterealisateurc->execute();    
        $nombrerealisateurc = $requeterealisateurc->fetch();
?>

<form action="edit_realisateurs.php?action=editer2&realisateur_id=<?php echo $_POST["realisateur_id"];?>" method="POST">
            <div class="ligneajout">            
                    <div class="ligneajouttitre"> Prénom du réalisateur</div>

                    <div class="ligneajoutform"><input type="text" name="prenom_realisateur" value="<?php echo $nombrerealisateurc["prenom_realisateurs"]?>"></div>
            </div> <!-- fin de ma ligne ajout -->

            <div class="ligneajout">            
                    <div class="ligneajouttitre"> Nom du réalisateur</div>

                    <div class="ligneajoutform"><input type="text" name="nom_realisateur" value="<?php echo $nombrerealisateurc["nom_realisateurs"]?>"></div>
            </div> <!-- fin de ma ligne ajout -->

            <div class="ligneajout">            
                    <div class="ligneajouttitre"> Date naissance du réalisateur</div>

                    <div class="ligneajoutform"><input type="date" name="datenaissance_realisateur"  value="<?php echo $nombrerealisateurc["datenaissance_realisateurs"]?>"></div>
            </div> <!-- fin de ma ligne ajout -->

            <div class="ligneajout">
                <input type="submit" value="J'ajoute ce(tte) réalisateur(rice)">
            </div> <!-- fin de ma ligne ajout -->
            </form>

            <hr class="style-two">
                </hr>

<?php
    }
}
 ?>


            

            <div class="ligneajout">

                <form action="edit_realisateurs.php?action=editer" method="POST">
                    Choisir le réalisateur à éditer:
                    <select name="realisateur_id" id="acteur_id">
                        <option value="">--Choisir le realisateur à modifier--</option>

                        <?php 

$sqlrealisateurs = "SELECT * FROM realisateurs ORDER BY nom_realisateurs ASC";
$requeterealisateurs=$db->prepare($sqlrealisateurs);
$requeterealisateurs->execute();    
while ($afficherealisateurs = $requeterealisateurs->fetch())
{
    ?>
                        <option value="<?php echo $afficherealisateurs["id_realisateurs"];?>">
                            <?php echo $afficherealisateurs["nom_realisateurs"]; echo " "; echo $afficherealisateurs["prenom_realisateurs"];
}

?>
                    </select>
                    <input type="submit" value="J'édite ce(tte) réalisateur(trice)">
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