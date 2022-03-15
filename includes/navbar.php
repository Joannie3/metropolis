        <!-- navbar -->
        <nav>
            <div class="menug">

                <div class="navlogo"><img src="img/navbar/metropolis.png"></div>

                <div class="navmenu">

                    <div class="titrenav"><a href="listefilm.php">Films</a></div>
                    <!-- <div class="titrenav"><a href="">Séries</a></div> -->
                    <div class="titrenav"><a href="recherche.php">Recherche</a></div>
                    <!-- <div class="titrenav"><a href="">Mon Compte</a></div> -->
<?php
$id_membres =  $_SESSION["membres"]["id"];

$sqladmin = "SELECT * FROM `membres` WHERE id_membres=".$id_membres."";
$requeteadmin=$db->prepare($sqladmin);
$requeteadmin->execute();
$afficheadmin = $requeteadmin->fetch();

if ($afficheadmin["roles_membres"] == '1'){ echo "<div class='titrenav'><a href='administration.php'>Administration</a></div>";}
else{}

?>

                    <div class="titrenav"><a href="deconnexion.php">Se Déconnecter</a></div>

                </div>


                <div id="nav-burger" class="nav-burger">☰

                    <div id="nav-burger-list" class="nav-burger-list">
                        <div class="nav-burger-list2">
                        <div class=titrenav"><a href="listefilm.php">Films</a></div>
                    <!-- <div class="titrenav"><a href="">Séries</a></div> -->
                    <!-- <div class="titrenav"><a href="">Mon Compte</a></div> -->

                    <?php if ($afficheadmin["roles_membres"] == '1'){ echo "<div class='titrenav'><a href='administration.php'>Administration</a></div>";} else{} ?>

                    <div class="titrenav"><a href="deconnexion.php">Se Déconnecter</a></div>
                        </div>
                    </div>


                </div>



            </div>
        </nav>
        <!-- navbar -->