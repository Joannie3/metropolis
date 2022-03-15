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
    <title>Metropolis - Administration</title>
</head>

<body>
    <div class="container">

         <div class="ajoutfilmbase"><h1><span>A</span>jouter un film</h1>
   

                <form action="traitement_ajoutfilm.php" method="POST">


                <div class="ligneajout">
                    <div class="ligneajouttitre"> Titre film :</div>       
                    <div class="ligneajoutform"><input type="text" name="titre" placeholder="Titre film" maxlenght="20"  /></div>
                </div>  <!-- fin de ma ligne ajout -->
               
                <div class="ligneajout">
                    <div class="ligneajouttitre"> Durée du film :</div>       
                    <div class="ligneajoutform"><input type="time" name="duree" maxlenght="20"  /></div>
                </div>  <!-- fin de ma ligne ajout -->     

                <div class="ligneajout">
                    <div class="ligneajouttitre"> Date de sortie :</div>       
                    <div class="ligneajoutform"><input type="date" name="datesortie" maxlenght="20"  /></div>
                </div>  <!-- fin de ma ligne ajout -->      
 
                <div class="ligneajout">
                    <div class="ligneajouttitre"> Pegi film :</div>       
                    <div class="ligneajoutform">
                    <select name="pegi" id="pegi-select">
                    <option value="">--Choisir le PEGI--</option>
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
                    <div class="ligneajoutform"><textarea width="350px" height="200px" name="synopsis"></textarea></div>
                </div>  <!-- fin de ma ligne ajout -->        

                <div class="ligneajout">
                    <div class="ligneajouttitre"> Affiche film :</div>        
                    <div class="ligneajoutform"><input type="text" name="affiche" placeholder="affiche film JPG/PNG ..." maxlenght="20" /></div>
                </div>  <!-- fin de ma ligne ajout -->   

                <div class="ligneajout">
                    <div class="ligneajouttitre"> Video film :</div>        
                    <div class="ligneajoutform"><input type="text" name="video" placeholder="nom de la video" maxlenght="20" /></div>
                </div>  <!-- fin de ma ligne ajout -->     

                <div class="ligneajout">
                    <input type="submit" value="Je valide le formulaire">
                </div>  <!-- fin de ma ligne ajout -->     
            
            </form>

         </div>


    </div> <!-- container -->
    <?php
    }
    else{
        header("Location: index.php");
    }
}
    ?>
    
</body>
</html>