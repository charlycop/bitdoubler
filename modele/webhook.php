<?php
$json = file_get_contents("php://input");

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

if ($nb_confirmations == 0)
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
		// On envoie la rétribution au parrain après 6 confirmations
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

echo 'SALUT';
?>