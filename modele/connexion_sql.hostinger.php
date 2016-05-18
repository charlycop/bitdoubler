<?php

// Connexion à la base de données
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=u224959868_btc;charset=utf8', 'u224959868_btc', 'evFDT8SiI3');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}