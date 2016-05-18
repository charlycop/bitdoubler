<?php
session_start(); // On démarre la session AVANT toute chose
include_once('connexion_sql.php');

//On charge le SDK de blocktrail
require '../vendor/autoload.php';
use Blocktrail\SDK\BlocktrailSDK;

$useraddress = htmlspecialchars($_POST['useraddress']);
include('addresschecker.php');
include('user_exist.php');

// Si l'adresse est correcte, on cré le compte
if (adresschecker($useraddress))
	{
		if  (!user_exist($useraddress))
		{
			// Connexion à l'API
			$client = new BlocktrailSDK("c614645a7f5d94b961ec3ed3dbd036c64ba42f34", "ef41c854d7fb246f5a4445d07cb9fe2a5b25a15f", "BTC", true /* testnet */);
		 	$wallet = $client->initWallet("wallet2", "254777");
			$depositaddress = $wallet->getNewAddress();

			//création d'un code unique d'affilié
			$affcode = (substr(sha1($useraddress), -8));
		
			//On ajoute le tout dans la BDD
			include_once('post_user.php');
			$user_id=post_user($useraddress,$depositaddress,$affcode);

			//On cré l'event dans le webhook
			$client->subscribeAddressTransactions('testwebhook', $depositaddress, 6);

			//On ferme la session vide
			session_destroy();

			// On démarre la réelle session
			session_start();
		    $_SESSION['user_id'] = $user_id;
		    $_SESSION['useraddress'] = $useraddress;
		    $_SESSION['depositaddress'] = $depositaddress;
		    $_SESSION['affcode'] = $affcode;
		}

	header('Location: ../index.php?account='.$useraddress.'');
	}

else
	{
		echo "L'adresse BTC n'est pas correcte.";
        ?>
        <br><a href="../index.php">Retour</a>
        <?php
	}
?>