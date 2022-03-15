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
    <script src="https://kit.fontawesome.com/a767fd33a4.js" crossorigin="anonymous"></script>
    <link href="css/style.css" rel="stylesheet">
    <title>Metropolis, le ciné chez vous !</title>
</head>

<body>

    <div class="indexlogo">

        <div class="indeximagegauche"><img src="img/accueil/logo.png"></div>

        <div class="indexpresentationdroite">

            <div class="indexpresentationtitre"><span>M</span>ETROPOLIS

                <hr class="style-two">
                </hr>

            </div>

            <div class="indexpresentationdes">
                <p>
                    Dès aujourd'hui, et grâce à <span>M</span>etropolis, le cinéma arrive chez vous !<br>
                    Vous pourrez dès a présent regarder les films et séries qui viennent tout juste de sortir. <br>
                    Metropolis s'engage à vous proposer un catalogue avec des nouveautés régulièrement<br>

                </p>
            </div>

            <div class="indexco">
                <div class="indexinscription"><a href="inscription.php">Inscription</a></div>
                <div class="indexconnexion"><a href="connexion.php">Connexion</a></div>
            </div>

        </div>
    </div>


    <div class="seperationhr">
        <hr class="style-two">
        </hr>
    </div>


    <div class="cinechezvous">

        <div class="cinechezvoustexte">

            <div class="cinechezvoustitre"><span>L</span>e <span>c</span>iné <span>c</span>hez <span>v</span>ous</div>

            <div class="cinechezvousdescription">
                <span>M</span>etropolis est le site de streaming qu'il vous faut.<br><br>

                Nous vous attendons afin de vous faire profiter d'une multitude de films et de séries. <br>
                Vous trouverez toujours un film ou une série qui vous plairont.<br><br>

                <span>M</span>etropolis est accessible sur tout support, Smart TV, PlayStation, Xbox, Chromecast, Apple
                TV, lecteurs Blu-ray et bien plus.

                L'équipe de <span>M</span>etropolis est à votre écoute.
            </div>

        </div>

        <div class="cinechezvousimage"><img src="img/accueil/deadpool.png"></div>

    </div>


    <!-- paralax -->

    <div class="top"></div>

    <div class="parallax1"></div>

    <div class="middle"></div>



    <div class="metropolis">

        <div class="metropolisimage"><img src="img/accueil/nemo.png"><br><br><br><br></div>
        <div class="metropolisdescription">

            <div class="cinechezvoustitre">
                <div class="titre1"> <span>M</span>etropolis <span>p</span>our <span>t</span>oute <span>l</span>a
                    <span>f</span>amille
                </div>
            </div>

            <div class="cinechezvousdescription">
                <div class="titre2"> <span>M</span>etropolis est accessible pour les grands mais aussi pour les
                    petits.<br><br>

                    Nous proposons un grand choix de films et de séries.<br><br>

                    Nous avons un grand choix de film d'animation, vous pouvez creer des profils pour vos enfants et
                    limités leur accès en toute sécurité<br>

                </div>
            </div>
        </div>


    </div>

    <div class="seperationhr">
        <hr class="style-two">
        </hr>
    </div>

    <?php include('includes/footer.php'); ?>

</body>

</html>