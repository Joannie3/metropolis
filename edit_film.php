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
    <title>Metropolis - Edition film</title>
</head>

<body>
    <div class="container">
        <div class="ajoutfilmbase">

            <h1>Editer un film - <a href="administration.php">Retour a l'administration</a></h1>

            <?php
if(isset($_GET["action"]))
{
    if ($_GET["action"] == 'editer')
    {

    

        if (isset($_GET["film_id"])){$lien = $_GET["film_id"];}
        else {$lien = $_POST["film_id"];}

        $sqlfilmc = "SELECT * FROM films WHERE id_films=".$lien."";
        $requetefilmc=$db->prepare($sqlfilmc);
        $requetefilmc->execute();    
        $nombrefilmc2 = $requetefilmc->fetch();

        if(isset($_GET["a"]))
        {
            if ($_GET["a"] == 'b')
            {
              
               $idfilm = $_GET["film_id"];

                $titrefilm = strip_tags($_POST["titre"]);
                $dureefilm = $_POST["duree"];
                $datesortiefilm = $_POST["datesortie"];
                $pegifilm = strip_tags($_POST["pegi"]);
                $synopsisfilm = strip_tags($_POST["synopsis"]);
                $affichefilm =$_POST["affiche"];
                $videofilm = $_POST["video"];

                $sql3 = "UPDATE films SET titre_films = ?, synopsis_films = ?, duree_films = ?, datesortie_films = ?, pegi_films = ?, affiche_films = ?, affiche2_films = ?, video_films = ?  WHERE id_films=".$idfilm."";
                $requete3 = $db->prepare($sql3);
                $requete3->execute(array($titrefilm, $synopsisfilm, $dureefilm, $datesortiefilm, $pegifilm, $affichefilm, $affichefilm, $videofilm));


echo"  On a mis a jour le film ";

            }

        }



        $sqlfilmc = "SELECT * FROM films WHERE id_films=".$lien."";
        $requetefilmc=$db->prepare($sqlfilmc);
        $requetefilmc->execute();    
        $nombrefilmc2 = $requetefilmc->fetch();
        ?>

            <form action="edit_film.php?action=editer&a=b&film_id=<?php echo $lien;?>" method="POST">

                <div class="ligneajout">
                    <div class="ligneajouttitre"> Titre film :</div>
                    <div class="ligneajoutform"><input type="text" name="titre" value="<?php echo $nombrefilmc2["titre_films"]?>" maxlenght="20" /></div>
                </div> <!-- fin de ma ligne ajout -->

                <div class="ligneajout">
                    <div class="ligneajouttitre"> Durée du film :</div>       
                    <div class="ligneajoutform"><input type="time" name="duree" maxlenght="20" value="<?php echo $nombrefilmc2["duree_films"]?>" /></div>
                </div>  <!-- fin de ma ligne ajout -->     

                <div class="ligneajout">
                    <div class="ligneajouttitre"> Date de sortie :</div>       
                    <div class="ligneajoutform"><input type="date" name="datesortie" maxlenght="20" value="<?php echo $nombrefilmc2["datesortie_films"]?>" /></div>
                </div>  <!-- fin de ma ligne ajout -->      

                <div class="ligneajout">
                    <div class="ligneajouttitre"> Pegi film :</div>       
                    <div class="ligneajoutform">
                    <select name="pegi" id="pegi-select">
                    <option value="<?php echo $nombrefilmc2["pegi_films"]?>">+ <?php echo $nombrefilmc2["pegi_films"]?> ans</option>
                    <option value="3">+3 ans</option>
                    <option value="7">+7 ans</option>
                    <option value="12">+12 ans</option>
                    <option value="16">+16 ans</option>
                    <option value="18">+18 ans</option>
                    </select>
                    </div>
                </div>  <!-- fin de ma ligne ajout -->       
 
                <div class="ligneajout">
                    <div class="ligneajouttitre"> Synopsis :</div>        
                    <div class="ligneajoutform"><textarea width="350px" height="200px" name="synopsis" value="<?php echo $nombrefilmc2["synopsis_films"]?>">
                    <?php echo $nombrefilmc2["synopsis_films"]?></textarea></div>
                </div>  <!-- fin de ma ligne ajout -->        

                <div class="ligneajout">
                    <div class="ligneajouttitre"> Affiche film :</div>        
                    <div class="ligneajoutform"><input type="text" name="affiche" value="<?php echo $nombrefilmc2["affiche_films"]?>" maxlenght="20" /></div>
                </div>  <!-- fin de ma ligne ajout -->   

                <div class="ligneajout">
                    <div class="ligneajouttitre"> Video film :</div>        
                    <div class="ligneajoutform"><input type="text" name="video" value="<?php echo $nombrefilmc2["video_films"]?>" maxlenght="20" /></div>
                </div>  <!-- fin de ma ligne ajout -->     

                <div class="ligneajout">
                    <input type="submit" value="Je valide le formulaire">
                </div>  <!-- fin de ma ligne ajout -->     

            </form>


            <hr class="style-two">
                </hr>

            <?php


    }
}


?>
            <div class="ligneajout">

                <form action="edit_film.php?action=editer" method="POST">
                    Choisir le film à éditer:
                    <select name="film_id" id="film">
                        <option value="">--Choisir le film à modifier--</option>

                        <?php 
                $sqlfilm = "SELECT * FROM films ";
                $requetefilm=$db->prepare($sqlfilm);
                $requetefilm->execute();    
                while ($affichefilm = $requetefilm->fetch())
                {
                    ?>
                        <option value="<?php echo $affichefilm["id_films"];?>">
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
    else{header("Location: index.php");}
}
    ?>
</body>

</html>