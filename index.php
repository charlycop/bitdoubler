<?php
session_start(); // On démarre la session AVANT toute chose
include_once('modele/connexion_sql.php');

//On charge le SDK de blocktrail
require 'vendor/autoload.php';
use Blocktrail\SDK\BlocktrailSDK;

if (isset($_SESSION['user_id']))
{
    include('vue/compte.php');
}
elseif (isset($_GET['account'])) 
{
    include_once('modele/get_user.php');
    $user = get_user(htmlspecialchars($_GET['account']));

    //On ferme la session vide
    session_destroy();

    // On démarre la réelle session
    session_start();
    $_SESSION['user_id'] = $user['id_user'];
    $_SESSION['useraddress'] = htmlspecialchars($_GET['account']);
    $_SESSION['depositaddress'] = $user['depositaddress'];
    $_SESSION['affcode'] = $user['affcode'];

    include('vue/compte.php');
}

else
{   
    include('vue/welcome.php');
}