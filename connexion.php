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
    <title>Metropolis - Connexion</title>
</head>

<body>


    <div class="container">

        <div class="inscription">

            <div class="inscriptionimageg"><img src="img/inscription/logoinscription.png"></div>

            <div class="inscriptionformulaire1">

                <div class="inscriptionensemble">

                    <div class="titreinscription"> <span>C</span>onnexion</div>

                    <hr class="style-two">
                </hr>

                    <form action="traitement_connexion.php" method="POST">

                    <div class="inscriptioncadre">
                        <div class="formulairelabel"> <span>E</span>-Mail : </div>

                        <div class="formulaireinput">
                            <input type="text" name="email" placeholder="Votre email" maxlenght="20" required />
                        </div>
                    </div> <!-- inscription cadre -->

                    <div class="inscriptioncadre">
                        <div class="formulairelabel"> <span>P</span>assword : </div>

                        <div class="formulaireinput">
                            <input type="password" name="password" placeholder="Votre mot de pass" maxlenght="20" required />
                        </div>
                    </div> <!-- inscription cadre -->

                    <div class="inscriptioncadre"><button> Je me connecte</button></div>


                    </form>

                </div> <!-- inscription ensemble -->


            </div><!-- inscription formulaire 1 -->

        </div><!-- continscriptionainer -->

    </div> <!-- container -->




</body>

</html>