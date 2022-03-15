<?php
    // ici on defini des constantes d'environnement
    // define("DBHOST", "db5006773359.hosting-data.io");
    // define("DBUSER", "dbu2229083");
    // define("DBPASS", "mV3m6k7F");
    // define("DBNAME", "dbs5603943");

    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "");
    define("DBNAME", "metropolis");

    // DSN de connexion
    $dsn = "mysql:dbname=".DBNAME.";host=".DBHOST;

    // on se co a la base de donnees
    try{
        // on instencie PDO
            $db = new PDO($dsn, DBUSER, DBPASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            // permet d etre sur d'envoyer les donnees en UTF8 pour avoir les accents etc
            $db->exec("SET NAMES utf8");

            // on defini le mode de fecth par defaut
            // $db->setAttribute(PDO::ATTR_DEFAULT_FETC_MODE, PDO::FETC_ASSOC);

   }
        catch(PDOException $e){
            die($e->getMessage());

        }