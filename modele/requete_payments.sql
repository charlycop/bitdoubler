# Sélectionner les paiements à effectuer
SELECT  ROUND(value/100*2) as value, 
		useradress, 
		id_deposit
from deposits
INNER JOIN id_user ON
			deposits.id_user=id_user.id_user
WHERE 
((nb_payouts < 10) AND (confirmations=6))


# Ajouter +1 au compteur de payouts
UPDATE deposits
SET nb_payouts = nb_payouts + 1
WHERE 
((nb_payouts < 10) AND (confirmations=6))


use Blocktrail\SDK\BlocktrailSDK;

$value = BlocktrailSDK::toSatoshi(1.1);
$wallet->pay(array(
	'2N1ep2XubVJVmcJ52MgqJBPSJYr8aRGyZmx' => '200',
	'2N1ep2XubVJVmcJ52MgqJBPSJYr8aRGyZmx' => '201',
	'2NAnWcydcmkJ2zng5GHqh7ZgbCVPuKYQTWD' => '202',
	'2NAnWcydcmkJ2zng5GHqh7ZgbCVPuKYQTWD' => '203',
	'2N1ep2XubVJVmcJ52MgqJBPSJYr8aRGyZmx' => '204'
), null, false, true, Wallet::FEE_STRATEGY_BASE_FEE);