<?php
session_start();

// si on est pas connecter on va sur connexion
if (!isset($_SESSION["membres"])){
    header("Location: connexion.php");
}

// fonction qui permet de supprimer une variable
unset($_SESSION["membres"]);

header("Location: index.php");

?>