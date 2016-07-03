<?php
// On récupère le JSON
$json = file_get_contents("php://input");

// On charge le SDK de blocktrail et on initialise le wallet
require '../vendor/autoload.php';
use Blocktrail\SDK\BlocktrailSDK;
$client = new BlocktrailSDK("c614645a7f5d94b961ec3ed3dbd036c64ba42f34", "ef41c854d7fb246f5a4445d07cb9fe2a5b25a15f", "BTC", False /* testnet */);
$wallet = $client->initWallet("wallet2", "254777");



//decoding the above JSON string
$transaction=json_decode($json, true);

// Envoyer le array dans un fichier log
$pourlog = print_r($transaction, true);
$monfichier = fopen('log.txt', 'r+');
fputs($monfichier , $pourlog);
fclose($monfichier);

// On sécurise les variables
$nb_confirmations = (int) $transaction['data']['confirmations'];
$estimated_value  = (int) $transaction['data']['estimated_value'];
$date_depot   	  = $transaction['data']['first_seen_at'];
$hash			  = htmlspecialchars($transaction['data']['hash']);

/*foreach($transaction['data']['outputs'] as $prop => $value)
	{
		$monfichiera = fopen('log.txt', 'a');
		fputs($monfichiera , $value['value']);
		fclose($monfichiera);
	}*/

foreach($transaction['data']['outputs'] as $prop => $value)
	{
		if ($value['value'] == $estimated_value)
		{
			$finalvalue = $estimated_value;
			
		}
	}

/* On sécurise les variables
foreach($transaction['addresses'] as $prop => $value)
	$depositaddress = htmlspecialchars($prop);

$nb_confirmations = (int) $transaction['data']['confirmations'];
$value 			  = (int) $transaction['data']['estimated_value'];
$date_depot   	  = $transaction['data']['first_seen_at'];
$hash			  = htmlspecialchars($transaction['data']['hash']);


/*On envoie un email à l'admin
$to = 'charlycop@free.fr';
$subject = 'Confirmation #'.$nb_confirmations.'';
$msg = 'Deposit address : '.$depositaddress.'<br>Valeur : '.$value.'<br>Transaction : '.$hash.'<br>Date : '.$date_depot.'<br>Deposit id : '.$deposit.'';
//$msg = '<p>Un nouveau commentaire vient d\'être posté sur votre billet intitulé '.$value.'.</p>';
$headers = 'From: BTC Doubler admin <1020916229@qq.com>'."\r\n";
$headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
$headers .= "\r\n";
mail($to, $subject, $msg, $headers);*/
?>