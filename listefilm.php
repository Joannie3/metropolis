<?php
session_start();

if (!isset($_SESSION["membres"])){
    header("Location: index.php");
    exit;
}
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
    <link href="css/style.css" rel="stylesheet">
    <title>Metropolis - L'avenir du streaming</title>
</head>

<body>

    <?php require_once "includes/bddconnexion.php";

// echo "id du membre :" ;
// echo $_SESSION["membres"]["id"];

?>



    <div class="container">

        <div class="slider">

            <!-- Ici je commence mon while -->
            <?php


$listefilmg = "SELECT * FROM films WHERE valide='1'";
$requetelistefilmg=$db->prepare($listefilmg);
$requetelistefilmg->execute();

while ($affichelistefilmg = $requetelistefilmg->fetch())
{
?>
            <img src="img/films/<?php echo $affichelistefilmg["affiche_films"]; ?>"
                alt="titre <?php echo $affichelistefilmg["titre_films"]; ?>" class="img__slider active">
            <div class="img__description active"><?php echo $affichelistefilmg["titre_films"]; ?></div>
            <?php
}
?>
            <!-- Ici je termine mon while -->

            <!-- 
            <img src="img/films/img1.jpg" alt="img1" class="img__slider active">
            <img src="img/films/img2.jpg" alt="img2" class="img__slider">
            <img src="img/films/img3.jpg" alt="img3" class="img__slider"> -->

            <div class="suivant"><i class="fa-solid fa-angle-right"></i></div>
            <div class="precedent"><i class="fa-solid fa-angle-left"></i></div>

        </div>

        <div class="slider2">
            <?php
$listefilmg2 = "SELECT * FROM films WHERE valide='1'";
$requetelistefilmg2=$db->prepare($listefilmg2);
$requetelistefilmg2->execute();

while ($affichelistefilmg2 = $requetelistefilmg2->fetch())
{
?>
            <img src="img/films/affiches/<?php echo $affichelistefilmg2["affiche2_films"]; ?>"
                alt="titre <?php echo $affichelistefilmg2["titre_films"]; ?>" class="img__slider2 active">
            <div class="img__description2 active"><?php echo $affichelistefilmg2["titre_films"]; ?></div>
            <?php
}
?>
            <!-- 

            <img src="img/films/affiches/img1.jpg" alt="img1" class="img__slider2 active">
            <img src="img/films/affiches/img2.jpg" alt="img2" class="img__slider2">
            <img src="img/films/affiches/img3.jpg" alt="img3" class="img__slider2"> -->

            <div class="suivant3"><i class="fa-solid fa-angle-right"></i></div>
            <div class="precedent3"><i class="fa-solid fa-angle-left"></i></div>
            <!-- 
            <div class="img__description2 active">Gravity</div>
            <div class="img__description2">Red Notice</div>
            <div class="img__description2">The Old Guard</div> -->

        </div>



        <?php include('includes/navbar.php'); ?>



        

        <div class="titrecarrousel"><span>A</span>ction</div>

        <div class="carrousel">

            <div class="conteneurcarrousel">

                <?php

$listefilmgactionv = "SELECT * FROM `films` WHERE valide='1'";
$requetefilmgactionv=$db->prepare($listefilmgactionv);
$requetefilmgactionv->execute();

while ($affichefilmgactionv = $requetefilmgactionv->fetch())
{ 
// 1 = action 
$listefilmgaction = "SELECT * FROM `avoir_genres` WHERE id_genres='1' and id_films=".$affichefilmgactionv['id_films']."";
$requetefilmgaction=$db->prepare($listefilmgaction);
$requetefilmgaction->execute();


    while ($affichefilmgaction = $requetefilmgaction->fetch())
    {   

        $listefilmg3 = "SELECT * FROM films WHERE id_films=".$affichefilmgaction["id_films"]."";
        $requetelistefilmg3=$db->prepare($listefilmg3);
        $requetelistefilmg3->execute();
      
            while ($affichelistefilmg3 = $requetelistefilmg3->fetch())
            {
                
                $synopsis2 = $affichelistefilmg3["synopsis_films"];
                $synopsis=  substr($synopsis2, 0, 60);  // limiter le nombre de caracteres qui s'affiche

                $originalHeure = $affichelistefilmg3['duree_films'];
                //original date is in format YYYY-mm-dd
                $timestamp = strtotime($originalHeure); 
                $heure = date("H", $timestamp);
                $minutes = date("i", $timestamp);
                
                $originalDate = $affichelistefilmg3['datesortie_films'];
                //original date is in format YYYY-mm-dd
                $timestamp2 = strtotime($originalDate); 
                $date = date("d/m/Y", $timestamp2);

                ?>
                <div class="img__carrousel">
                    <div class="image_films_c"  onclick="desFilms(this)">
                        <img src="img/films/<?php echo $affichelistefilmg3["affiche_films"];?>"
                            alt="titre <?php echo $affichelistefilmg3["titre_films"]; ?>"></div>
                    <div class="desc_film_c">
                        Titre : <?php echo $affichelistefilmg3["titre_films"];?><br>
                        Durée : <?php echo $heure."h".$minutes."min";?><br>
                        Date de sortie : <?php echo $date;?><br>
                        Pegi : +<?php echo $affichelistefilmg3["pegi_films"];?> ans<br>
                        Synopsis : <?php echo $synopsis;?> ... <br><br>
                        <a href="film.php?id_film=<?php echo $affichelistefilmg3["id_films"];?>"><i
                                class="fa-solid fa-circle-plus"></i></a></div>
                    <!-- substr voir cette methode en php pour afficher qu'une partie -->
                </div>
                <?php
            }
        
    }
    
}

?>
                <!-- 


                <div class="img__carrousel">
                    <div class="image_films_c" onclick="desFilms(1)"> <img src="img/films/img3.jpg" alt="img3"></div>
                    <div class="desc_film_c"> blablabla1</div>
                </div>
                <div class="img__carrousel">
                    <div class="image_films_c" onclick="desFilms(2)"> <img src="img/films/img1.jpg" alt="img1"></div>
                    <div class="desc_film_c"> blablabla2</div>
                </div>
                <div class="img__carrousel">
                    <div class="image_films_c" onclick="desFilms(3)"> <img src="img/films/img2.jpg" alt="img2"></div>
                    <div class="desc_film_c"> blablabla3</div>
                </div>
                <div class="img__carrousel">
                    <div class="image_films_c" onclick="desFilms(4)"> <img src="img/films/img3.jpg" alt="img3"></div>
                    <div class="desc_film_c"> blablabla4</div>
                </div>
                <div class="img__carrousel">
                    <div class="image_films_c" onclick="desFilms(5)"> <img src="img/films/img1.jpg" alt="img1"></div>
                    <div class="desc_film_c"> blablabla5</div>
                </div>
                <div class="img__carrousel">
                    <div class="image_films_c" onclick="desFilms(6)"> <img src="img/films/img2.jpg" alt="img2"></div>
                    <div class="desc_film_c"> blablabla</div>
                </div>
                <div class="img__carrousel">
                    <div class="image_films_c" onclick="desFilms(7)"> <img src="img/films/img3.jpg" alt="img3"></div>
                    <div class="desc_film_c"> blablabla</div>
                </div>
                <div class="img__carrousel">
                    <div class="image_films_c" onclick="desFilms(8)"> <img src="img/films/img2.jpg" alt="img2"></div>
                    <div class="desc_film_c"> blablabla</div>
                </div> -->


            </div>


            <div class="suivant2"><i class="fa-solid fa-angle-right"></i></div>
            <div class="precedent2"><i class="fa-solid fa-angle-left"></i></div>


        </div>


        <div class="titrecarrousel"><span>A</span>ventures</div>

        <div class="carrousel">

<div class="conteneurcarrousel">

    <?php

$listefilmgactionv = "SELECT * FROM `films` WHERE valide='1'";
$requetefilmgactionv=$db->prepare($listefilmgactionv);
$requetefilmgactionv->execute();

while ($affichefilmgactionv = $requetefilmgactionv->fetch())
{

// 1 = action 
$listefilmgaction = "SELECT * FROM `avoir_genres` WHERE id_genres='2' and id_films=".$affichefilmgactionv['id_films']."";
$requetefilmgaction=$db->prepare($listefilmgaction);
$requetefilmgaction->execute();


while ($affichefilmgaction = $requetefilmgaction->fetch())
{   

$listefilmg3 = "SELECT * FROM films WHERE id_films=".$affichefilmgaction["id_films"]."";
$requetelistefilmg3=$db->prepare($listefilmg3);
$requetelistefilmg3->execute();



while ($affichelistefilmg3 = $requetelistefilmg3->fetch())
{
    
    $synopsis2 = $affichelistefilmg3["synopsis_films"];
    $synopsis=  substr($synopsis2, 0, 60);  // limiter le nombre de caracteres qui s'affiche

    $originalHeure = $affichelistefilmg3['duree_films'];
    //original date is in format YYYY-mm-dd
    $timestamp = strtotime($originalHeure); 
    $heure = date("H", $timestamp);
    $minutes = date("i", $timestamp);
    
    $originalDate = $affichelistefilmg3['datesortie_films'];
    //original date is in format YYYY-mm-dd
    $timestamp2 = strtotime($originalDate); 
    $date = date("d/m/Y", $timestamp2);

    ?>
    <div class="img__carrousel">
        <div class="image_films_c"  onclick="desFilms(this)">
            <img src="img/films/<?php echo $affichelistefilmg3["affiche_films"];?>"
                alt="titre <?php echo $affichelistefilmg3["titre_films"]; ?>"></div>
        <div class="desc_film_c">
            Titre : <?php echo $affichelistefilmg3["titre_films"];?><br>
            Durée : <?php echo $heure."h".$minutes."min";?><br>
            Date de sortie : <?php echo $date;?><br>
            Pegi : +<?php echo $affichelistefilmg3["pegi_films"];?> ans<br>
            Synopsis : <?php echo $synopsis;?> ... <br><br>
            <a href="film.php?id_film=<?php echo $affichelistefilmg3["id_films"];?>"><i
                    class="fa-solid fa-circle-plus"></i></a></div>
        <!-- substr voir cette methode en php pour afficher qu'une partie -->
    </div>
    <?php

}
}
}
?>
</div>


<div class="suivant2"><i class="fa-solid fa-angle-right"></i></div>
<div class="precedent2"><i class="fa-solid fa-angle-left"></i></div>


</div>

<div class="titrecarrousel"><span>P</span>olicier</div>

<div class="carrousel">

<div class="conteneurcarrousel">

<?php

$listefilmgactionv = "SELECT * FROM `films` WHERE valide='1'";
$requetefilmgactionv=$db->prepare($listefilmgactionv);
$requetefilmgactionv->execute();

while ($affichefilmgactionv = $requetefilmgactionv->fetch())
{

// 1 = action 
$listefilmgaction = "SELECT * FROM `avoir_genres` WHERE id_genres='7' and id_films=".$affichefilmgactionv['id_films']."";
$requetefilmgaction=$db->prepare($listefilmgaction);
$requetefilmgaction->execute();


while ($affichefilmgaction = $requetefilmgaction->fetch())
{   

$listefilmg3 = "SELECT * FROM films WHERE id_films=".$affichefilmgaction["id_films"]."";
$requetelistefilmg3=$db->prepare($listefilmg3);
$requetelistefilmg3->execute();



while ($affichelistefilmg3 = $requetelistefilmg3->fetch())
{

$synopsis2 = $affichelistefilmg3["synopsis_films"];
$synopsis=  substr($synopsis2, 0, 60);  // limiter le nombre de caracteres qui s'affiche

$originalHeure = $affichelistefilmg3['duree_films'];
//original date is in format YYYY-mm-dd
$timestamp = strtotime($originalHeure); 
$heure = date("H", $timestamp);
$minutes = date("i", $timestamp);

$originalDate = $affichelistefilmg3['datesortie_films'];
//original date is in format YYYY-mm-dd
$timestamp2 = strtotime($originalDate); 
$date = date("d/m/Y", $timestamp2);

?>
<div class="img__carrousel">
<div class="image_films_c"  onclick="desFilms(this)">
    <img src="img/films/<?php echo $affichelistefilmg3["affiche_films"];?>"
        alt="titre <?php echo $affichelistefilmg3["titre_films"]; ?>"></div>
<div class="desc_film_c">
    Titre : <?php echo $affichelistefilmg3["titre_films"];?><br>
    Durée : <?php echo $heure."h".$minutes."min";?><br>
    Date de sortie : <?php echo $date;?><br>
    Pegi : +<?php echo $affichelistefilmg3["pegi_films"];?> ans<br>
    Synopsis : <?php echo $synopsis;?> ... <br><br>
    <a href="film.php?id_film=<?php echo $affichelistefilmg3["id_films"];?>"><i
            class="fa-solid fa-circle-plus"></i></a></div>
<!-- substr voir cette methode en php pour afficher qu'une partie -->
</div>
<?php

}
}
}
?>
</div>


<div class="suivant2"><i class="fa-solid fa-angle-right"></i></div>
<div class="precedent2"><i class="fa-solid fa-angle-left"></i></div>


</div>

<div class="titrecarrousel"><span>W</span>estern</div>

<div class="carrousel">

<div class="conteneurcarrousel">

<?php

$listefilmgactionv = "SELECT * FROM `films` WHERE valide='1'";
$requetefilmgactionv=$db->prepare($listefilmgactionv);
$requetefilmgactionv->execute();

while ($affichefilmgactionv = $requetefilmgactionv->fetch())
{

// 1 = action 
$listefilmgaction = "SELECT * FROM `avoir_genres` WHERE id_genres='9' and id_films=".$affichefilmgactionv['id_films']."";
$requetefilmgaction=$db->prepare($listefilmgaction);
$requetefilmgaction->execute();


while ($affichefilmgaction = $requetefilmgaction->fetch())
{   

$listefilmg3 = "SELECT * FROM films WHERE id_films=".$affichefilmgaction["id_films"]."";
$requetelistefilmg3=$db->prepare($listefilmg3);
$requetelistefilmg3->execute();



while ($affichelistefilmg3 = $requetelistefilmg3->fetch())
{

$synopsis2 = $affichelistefilmg3["synopsis_films"];
$synopsis=  substr($synopsis2, 0, 60);  // limiter le nombre de caracteres qui s'affiche

$originalHeure = $affichelistefilmg3['duree_films'];
//original date is in format YYYY-mm-dd
$timestamp = strtotime($originalHeure); 
$heure = date("H", $timestamp);
$minutes = date("i", $timestamp);

$originalDate = $affichelistefilmg3['datesortie_films'];
//original date is in format YYYY-mm-dd
$timestamp2 = strtotime($originalDate); 
$date = date("d/m/Y", $timestamp2);

?>
<div class="img__carrousel">
<div class="image_films_c"  onclick="desFilms(this)">
    <img src="img/films/<?php echo $affichelistefilmg3["affiche_films"];?>"
        alt="titre <?php echo $affichelistefilmg3["titre_films"]; ?>"></div>
<div class="desc_film_c">
    Titre : <?php echo $affichelistefilmg3["titre_films"];?><br>
    Durée : <?php echo $heure."h".$minutes."min";?><br>
    Date de sortie : <?php echo $date;?><br>
    Pegi : +<?php echo $affichelistefilmg3["pegi_films"];?> ans<br>
    Synopsis : <?php echo $synopsis;?> ... <br><br>
    <a href="film.php?id_film=<?php echo $affichelistefilmg3["id_films"];?>"><i
            class="fa-solid fa-circle-plus"></i></a></div>
<!-- substr voir cette methode en php pour afficher qu'une partie -->
</div>
<?php

}
}
}
?>
</div>


<div class="suivant2"><i class="fa-solid fa-angle-right"></i></div>
<div class="precedent2"><i class="fa-solid fa-angle-left"></i></div>


</div>




    </div>
    <!-- fin de mon container -->

    <?php include('includes/footer.php'); ?>

    <script src="js/javascript.js"></script>
</body>

</html>