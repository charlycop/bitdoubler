<?php
session_start(); // On démarre la session AVANT toute chose
include_once('modele/connexion_sql.php');

//On charge le SDK de blocktrail
require 'vendor/autoload.php';
use Blocktrail\SDK\BlocktrailSDK;

include('vue/index.php');