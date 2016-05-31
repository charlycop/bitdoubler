<?php
// On récupère le JSON
$json = file_get_contents("php://input");

// On charge le SDK de blocktrail et on initialise le wallet
require '../vendor/autoload.php';
use Blocktrail\SDK\BlocktrailSDK;
$client = new BlocktrailSDK("c614645a7f5d94b961ec3ed3dbd036c64ba42f34", "ef41c854d7fb246f5a4445d07cb9fe2a5b25a15f", "BTC", true /* testnet */);
$wallet = $client->initWallet("wallet2", "254777");

//decoding the above JSON string
$transaction=json_decode($json, true);

// On sécurise les variables
foreach($transaction['addresses'] as $prop => $value)
	$depositaddress = htmlspecialchars($prop);

$nb_confirmations = (int) $transaction['data']['confirmations'];
$value 			  = (int) $transaction['data']['estimated_value'];
$date_depot   	  = $transaction['data']['first_seen_at'];
$hash			  = htmlspecialchars($transaction['data']['hash']);


include_once('connexion_sql.php');
$userid = 10000;

if ($nb_confirmations >= 0)
{
	// On récupère les infos de l'user
	include('get_userdepot.php');
	$userdepot = userdepot($depositaddress);
	$userid = $userdepot['id_user'];
}
	
// On place le dépot dans la BDD
include('post_deposit.php');
$deposit = post_deposit($hash, $date_depot, $value, $depositaddress, $userid, $nb_confirmations);	


if ($nb_confirmations == 6)
	{
		// On récupère le code du parrain du parrain
		$parraincode = $userdepot['parraincode'];

		// On récupère dans la base l'useraddress du parrain
		include('get_parrainbtcaddress.php');
		$parrainUseraddress = get_parrainbtcaddress($parraincode);

		// On cré le Array avec le montant (10%) et l'useradress du parrain
		$parraingain = Array();
		$parraingain[$parrainUseraddress['useradress']] = $value / 100 * 10;
		$hashparrain=$wallet->pay($parraingain, null, false, true);

		// On update la BDD avec le numéro de transaction.
		include('update_hashparrain.php');
		update_hashparrain($hashparrain, $hash);

		// On envoi un mail pour tester
		$to = 'charlycop@free.fr';
		$subject = 'Paiement envoyé au parrain';
		$msg = 'Valeur : '.$parraingain['parrainUseraddress'].'<br>Transaction : '.$hashparrain.'<br>Date : '.$date_depot.'<br>Deposit id : '.$deposit.'';
		//$msg = '<p>Un nouveau commentaire vient d\'être posté sur votre billet intitulé '.$value.'.</p>';
		$headers = 'From: BTC Doubler admin <1020916229@qq.com>'."\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
		$headers .= "\r\n";
		mail($to, $subject, $msg, $headers);

	}

//On envoie un email à l'admin
$to = 'charlycop@free.fr';
$subject = 'Confirmation #'.$nb_confirmations.'';
$msg = 'Deposit address : '.$depositaddress.'<br>Valeur : '.$value.'<br>Transaction : '.$hash.'<br>Date : '.$date_depot.'<br>Deposit id : '.$deposit.'';
//$msg = '<p>Un nouveau commentaire vient d\'être posté sur votre billet intitulé '.$value.'.</p>';
$headers = 'From: BTC Doubler admin <1020916229@qq.com>'."\r\n";
$headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
$headers .= "\r\n";
mail($to, $subject, $msg, $headers);
?>