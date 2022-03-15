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
    <title>Metropolis - Gestion acteurs</title>
</head>

<body>
    <div class="container">

        <div class="ajoutfilmbase">
            <h1>Gestion des genres - <a href="administration.php">Retour a l'administration</a></h1>

            <?php
if (isset($_GET["action"]))
{
    if(isset($_GET["film_id"])) {$lien = $_GET["film_id"];}
    else {$lien = $_POST["film_id"];}

    if ($_GET["action"] == 'ajout')
    {
        if(isset($_GET["film_id"])) {$lien = $_GET["film_id"];}
        else {$lien = $_POST["film_id"];}


        $sqlgenrezero = "SELECT * FROM films WHERE id_films=".$lien."";
        $requetegenrezero=$db->prepare($sqlgenrezero);
        $requetegenrezero->execute();    
        $nombregenrezero = $requetegenrezero->fetch();

        echo "<h1>";
        echo $nombregenrezero["titre_films"];
        echo "</h1>";

        if (isset($_GET["a"])){
        if ($_GET["a"] == "b"){

            if (isset($_POST["genres"]))
            {

                foreach($_POST["genres"] as $genres)
                {

                    if ($genres == '1') {
                        //echo "action coché";
                        $sql1 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES (:genres, :idfilm)";
                        $query1 = $db->prepare($sql1);
                        $query1->execute(array(
                            ":genres" =>  $genres,
                            ":idfilm" => $_GET['film_id']
                        ));  

                    }
                    if ($genres == '2') {
                        // echo "aventure coché";
                        $sql2 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES (:genres, :idfilm)";
                        $query2 = $db->prepare($sql2); 
                        $query2->execute(array(
                            ":genres" =>  $genres,
                            ":idfilm" => $_GET['film_id']
                        ));  

                    }
                    if ($genres == '3') {
                        // echo "comedie coché";
                        $sql3 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES (:genres, :idfilm)";
                        $query3 = $db->prepare($sql3); 
                        $query3->execute(array(
                            ":genres" =>  $genres,
                            ":idfilm" => $_GET['film_id']
                        ));  

                    }
                    if ($genres == '4') {
                        // echo "drame coché";
                        $sql4 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES (:genres, :idfilm)";
                        $query4 = $db->prepare($sql4); 
                        $query4->execute(array(
                            ":genres" =>  $genres,
                            ":idfilm" => $_GET['film_id']
                        ));  

                    }
                    if ($genres == '5') {
                        // echo "fantastique coché";
                        $sql5 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES (:genres, :idfilm)";
                        $query5 = $db->prepare($sql5); 
                        $query5->execute(array(
                            ":genres" =>  $genres,
                            ":idfilm" => $_GET['film_id']
                        ));  

                    }
                    if ($genres == '6') {
                        // echo "guerre coché";
                        $sql6 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES (:genres, :idfilm)";
                        $query6 = $db->prepare($sql6); 
                        $query6->execute(array(
                            ":genres" =>  $genres,
                            ":idfilm" => $_GET['film_id']
                        ));  

                    }
                    if ($genres == '7') {
                        // echo "policier coché";
                        $sql7 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES (:genres, :idfilm)";
                        $query7 = $db->prepare($sql7); 
                        $query7->execute(array(
                            ":genres" =>  $genres,
                            ":idfilm" => $_GET['film_id']
                        ));  

                    }
                    if ($genres == '8') {
                        // echo "horreur coché";
                        $sql8 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES (:genres, :idfilm)";
                        $query8 = $db->prepare($sql8); 
                        $query8->execute(array(
                            ":genres" =>  $genres,
                            ":idfilm" => $_GET['film_id']
                        ));  

                    }
                    if ($genres == '9') {
                        // echo "western coché";
                        $sql9 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES (:genres, :idfilm)";
                        $query9 = $db->prepare($sql9); 
                        $query9->execute(array(
                            ":genres" =>  $genres,
                            ":idfilm" => $_GET['film_id']
                        ));  

                    }
                    if ($genres == '10') {
                        // echo "SF coché";
                        $sql10 = "INSERT INTO `avoir_genres`(`id_genres`, `id_films`) VALUES (:genres, :idfilm)";
                        $query10 = $db->prepare($sql10);
                        $query10->execute(array(
                            ":genres" =>  $genres,
                            ":idfilm" => $_GET['film_id']
                        ));  
                    }

                }

                $sql13 = "UPDATE films SET `valide_genres`='1' WHERE id_films=:idfilm";
                $query13 = $db->prepare($sql13);
                $query13->execute(array(
                    ":idfilm" => $_GET['film_id']
                ));  
                
                echo "Les genres sont ajoutés au film ";
                echo $nombregenrezero["titre_films"];

            }

        }

    }
        ?>

            <div class="basegenres">

                <form action="ajout_genres?action=ajout&a=b&film_id=<?php echo $lien;?>" method="POST">

                    <input type="checkbox" id="Action" name="genres[]" value="1">Action
                    <input type="checkbox" id="Aventure" name="genres[]" value="2">Aventure
                    <input type="checkbox" id="Comédie" name="genres[]" value="3">Comédie
                    <input type="checkbox" id="Drame" name="genres[]" value="4">Drame
                    <input type="checkbox" id="Fantastique" name="genres[]" value="5">Fantastique<br>

                    <input type="checkbox" id="Guerre" name="genres[]" value="6">Guerre
                    <input type="checkbox" id="Policier" name="genres[]" value="7">Policier
                    <input type="checkbox" id="Horreur" name="genres[]" value="8">Horreur
                    <input type="checkbox" id="Western" name="genres[]" value="9">Western
                    <input type="checkbox" id="Science-Fiction" name="genres[]" value="10">Science-Fiction<br><br>

                    <input type="submit" value="Je valide mes choix">

                </form>
            </div>


            <?php
         
    }
}

// 
                
                ?>

<hr class="style-two">
                </hr>

            <div class="ligneajout">

                <form action="ajout_genres.php?action=ajout" method="POST">
                    Choisir le film :
                    <select name="film_id" id="film">
                        <option value="">--Choisir le film pour ajouter les genres--</option>

                        <?php 
                                $sqlgenrezero = "SELECT * FROM films WHERE valide_genres='0'";
                                $requetegenrezero=$db->prepare($sqlgenrezero);
                                $requetegenrezero->execute();    
                                while ($nombregenrezero = $requetegenrezero->fetch())
                                {
                                    ?>
                        <option value="<?php echo $nombregenrezero["id_films"];?>">
                            <?php echo $nombregenrezero["titre_films"];
                                }

?>
                    </select>
                    <input type="submit" value="Je sélectionne les genres">
                </form>

            </div>


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