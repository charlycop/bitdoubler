<?php
session_start(); // On démarre la session AVANT toute chose
include_once('modele/connexion_sql.php');

// On vérifie si le paramètre de langue est indiqué dans l'URL et on l'insert dans le cookie
if (isset($_GET['lang']) AND (htmlspecialchars($_GET['lang'])=='cn' OR htmlspecialchars($_GET['lang'])=='en'))
	{
		setcookie('btclang', htmlspecialchars($_GET['lang']), time() + 365*24*3600, null, null, false, true);

		if (htmlspecialchars($_GET['lang'])=='en')
			{
				$lang = 'en';
				$langliste = 'cn';
			}	

		else
			{
				$lang = 'cn';
				$langliste = 'en';
			}

	}

else
	{
		// On définit la langue depuis le cookie
		if (isset($_COOKIE['btclang']))
			{
				if (htmlspecialchars($_COOKIE['btclang'])=='en')
					{
						$lang = 'en';
						$langliste = 'cn';
					}	

				else
					{
						$lang = 'cn';
						$langliste = 'en';
					}
			}

		else
			{
				$lang = 'en';
				$langliste = 'cn';
			}
	}

// On insert les textes dans la langue
include_once('vue/translations/'.$lang.'.php');

//On traite les messages d'erreurs du traitement du formulaire de contact
if (isset($_GET['mail']) AND 
	((htmlspecialchars($_GET['mail']) == 'ok') 
	OR (htmlspecialchars($_GET['mail']) == 'unknownok') 
	OR (htmlspecialchars($_GET['mail']) == 'btcaddressnok') 
	OR (htmlspecialchars($_GET['mail']) == 'captchanok')))
	{
		if (htmlspecialchars($_GET['mail']) == 'ok')
			{	
				$error = $emailok;
			}

			elseif (htmlspecialchars($_GET['mail']) == 'unknownok') 
			{
				$error = $emailnok;
			}

			elseif (htmlspecialchars($_GET['mail']) == 'captchanok')
			{
				$error = $captchanok;
			}

		else
			{
				$error = $emailnokbtc;
			}
	}

//On charge le SDK de blocktrail
require 'vendor/autoload.php';
use Blocktrail\SDK\BlocktrailSDK;

include('vue/index.php');