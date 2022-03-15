<?php
session_start();
$id_membres = $_SESSION["membres"]["id"];

require_once "includes/bddconnexion.php";
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
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>

<?php include('includes/navbar.php'); 



// Supprime les balises HTML et PHP d'une chaîne
@$recherche = strip_tags($_POST["recherche"]);

// on verifie qd on clique sur le boutonrecherche soit plein et mon input recherche soit non vide
// trim Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
if (isset($_POST["boutonrecherche"]) && !empty(trim($recherche)))
{
// on prend chaque mot de la recherch et on les separent
$mots = explode(" ",trim($recherche));

// on fait un tableau avec tous les resultats de chaque mots
for ($i2=0; $i2<count($mots); $i2++)
    $tableauxmots[$i2] = "titre_films like '%".$mots[$i2]."%'";

// un seul mot dans la recherche
// la je dis que je cherche le mot clé dans mon titre
$sqlrecherche = "SELECT id_films, titre_films, affiche_films FROM films WHERE valide='1' AND ".implode(" or ", $tableauxmots)." ";
$requeterecherche=$db->prepare($sqlrecherche);
$requeterecherche->execute(); 
$afficherecherche = $requeterecherche->fetchAll(PDO::FETCH_ASSOC);

}

?>

<div class="container">

    <div class="recherchebase"><h1>Recherche</h1>
        <div class="barrerecherche">
            <form  method="POST" action="recherche.php?a=r">
            <input type="text" name="recherche" value="<?php if(!empty($_POST["recherche"])) {echo $_POST["recherche"];} ?>" placeholder="Mots-clés ...">    
            <input type="submit" name="boutonrecherche" value="Rechercher" class="boutonr">
            </form>
        </div>

<?php

if (isset($_GET["a"])){

    if ($_GET["a"] == "r"){

        // deuxieme count, veut dire que si mon resultat est supp a 1 alors je met au pluriel sinon je laisse comme ça

            ?>      
                        <div class="nbresultats"> <?=count($afficherecherche)." ".(count($afficherecherche)>1?"resultats trouvés":"resultat trouvé");?></div> <!-- fin nbresultats  -->
                        
                
                            <div class="seperationhr"><hr class="style-two"></hr></div> <!-- fin separationhr  -->
                       
                                <div class="resultats">

                                     <div class="imagerecherche">
                                    
                                             <?php for($i=0; $i < count($afficherecherche); $i++ )
                                                 {
                                            ?>
                                        
                                                
                                                            <div class="imageresultat"> 
                                                            <a href="film.php?id_film=<?php echo $afficherecherche[$i]["id_films"];?>"><img src="img/films/<?php echo $afficherecherche[$i]["affiche_films"];?>">
                                                            <div class="imagerecherchetitre"><?php echo $afficherecherche[$i]["titre_films"];?></div></a>
                                                            </div>
                                                    
                                                
                                               
                                            
                                           
                                            
                                            
                                            <?php

                                        }
                                    ?>

                                    </div><!-- fin resultats  -->
                                    <?php 
      
                                       }// get A == r
} // get A


?>
                                </div><!-- fin resultats  -->
            </div>      <!-- fin baserecherche  -->
        </div> <!-- fin container  -->


    <div class="seperationhr">
        <hr class="style-two" style="background:red">
        </hr>
    </div>

</div> <!-- container -->

<?php include('includes/footer.php'); ?>

</body>

</html>