<?php
session_start();
if (isset($_SESSION["membres"])){
    header("Location: listefilm.php");
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
    <title>Metropolis - Inscription</title>
</head>

<body>


    <div class="container">

        <div class="inscription">

            <div class="inscriptionimageg"><img src="img/inscription/logoinscription.png"></div>

            <div class="inscriptionformulaire1">

                <div class="inscriptionensemble">

                    <div class="titreinscription"> <span>I</span>nscription</div>

                    <hr class="style-two">
                </hr>

                    <form action="traitement_inscription.php" method="POST">

                    <div class="inscriptioncadre">

                       

                            <div class="formulairelabel"> <span>C</span>ivilité :</div>

                            <div class="formulaireinput"> Monsieur : &nbsp;
                                <input type="radio" id="civilite" name="civilite" value="Monsieur">
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                Madame : &nbsp; <input type="radio" id="civilite" name="civilite" value="Madame"></div>

                    </div> <!-- inscription cadre -->

                    <div class="inscriptioncadre">
                        <div class="formulairelabel"> <span>N</span>om : </div>

                        <div class="formulaireinput">
                            <input type="text" name="nom" placeholder="Votre nom" maxlenght="20" required />
                        </div>
                    </div><!-- inscription cadre -->

                    <div class="inscriptioncadre">
                        <div class="formulairelabel"> <span>P</span>rénom : </div>

                        <div class="formulaireinput">
                            <input type="text" name="prenom" placeholder="Votre prenom" maxlenght="20" required />
                        </div>

                    </div><!-- inscription cadre -->

                    <div class="inscriptioncadre">
                        <div class="formulairelabel"> <span>P</span>assword : </div>

                        <div class="formulaireinput">
                            <input type="password" name="password" placeholder="Mot de pass" maxlenght="50" required />
                        </div>

                    </div><!-- inscription cadre -->

                    <div class="inscriptioncadre">
                        <div class="formulairelabel"> <span>E</span>-Mail : </div>

                        <div class="formulaireinput">
                            <input type="text" name="email" placeholder="Votre email" maxlenght="20" required />
                        </div>
                    </div> <!-- inscription cadre -->

                    <div class="inscriptioncadre">
                        <div class="formulairelabel"> <span>F</span>orfait : </div>

                        <div class="formulaireinput">
                            Forfait 15€ / mois <br>( 4 écrans simultanément)
                        </div>
                    </div> <!-- inscription cadre -->

                    <div class="inscriptioncadre"><button> Je valide mon inscription</button></div>


                    </form>

                    <!-- <div class="inscriptioncadre"><br><br>
                    <a href="connexion.php"> Vous avez déjà un compte ? Connectez vous ici !</a> </div> -->

                </div> <!-- inscription ensemble -->


            </div><!-- inscription formulaire 1 -->

        </div><!-- continscriptionainer -->

    </div> <!-- container -->




</body>

</html>