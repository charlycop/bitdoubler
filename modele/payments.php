<?php
    // On charge le SDK de blocktrail et on initialise le wallet
    require '../vendor/autoload.php';
    use Blocktrail\SDK\BlocktrailSDK;
    $client = new BlocktrailSDK("c614645a7f5d94b961ec3ed3dbd036c64ba42f34", "ef41c854d7fb246f5a4445d07cb9fe2a5b25a15f", "BTC", True /* testnet */);
    $wallet = $client->initWallet("wallet2", "254777");

    // On se connecte à la BDD
    include_once('connexion_sql.php');

    // On récupère la liste des paiements à faire depuis la BDD
    include('get_topayout.php');
    $payoutAvecDoublons = topayout();

    // Boucle générale si on a au moins un paiement a faire
    if (isset($payoutAvecDoublons[0]))
    {
        // On initialise les variables (adresse, montant) pour l'API
        $payoutArraySansDoublon=Array();
        $listIdDepositPaid=Array();

        // On rempli un array DONC SANS DOUBLON au format demandé par l'API partir des données brut de la BDD récupérées dans $payoutList 
        foreach($payoutAvecDoublons as $cle)
        {
            // On fait une condition claire pour éviter les doublons dans la création des deux listes 
            if (!isset($payoutArraySansDoublon[$cle['useradress']]))
            {
                // On crée l'Array dédoublonné pour l'API sans le id_deposit
                $payoutArraySansDoublon[$cle['useradress']] = (int) $cle['value'];

                // On récupère la liste des id_deposit uniquement
                $listIdDepositPaid[] = (int) $cle['id_deposit'];
            }
        }

        // On lance effectivement les paiements via l'API et on récupère le numero de transaction dans $hash_payments
        $hash_payments=$wallet->pay($payoutArraySansDoublon, null, false, true);

        if (isset($hash_payments))
        {
            // On fige la date de transaction
            $datetimepayout = date("Y-m-d H:i:s");

            // On archive chaque paiement de $payoutSansDoublonUpdate dans la table payouts
            include('post_payout.php');
            $retourMajBddPayouts=post_payout($hash_payments, $listIdDepositPaid, $datetimepayout);

            if ($retourMajBddPayouts)
            {
                $bilanbdd = 'Mise a jour BDD payouts OK';

                // On met à jour le last_payout dans la table deposits 
                include('update_last_payout.php');
                update_last_payout($listIdDepositPaid, $datetimepayout);
            }

            else
            {
                $bilanbdd = 'Mise a jour BDD payouts NOK';
            }

        }

        else
        {
            echo 'Soucis lors du batch de payment';
        }
        print_r($payoutArraySansDoublon);
        $out1 = ob_get_contents();

        print_r($payoutAvecDoublons);
        $out2 = ob_get_contents();

        $msgemail = 'Deposit address : '.$hash_payments.'<br/>'.$bilanbdd.'<br/><br/>'.$out1.'<br/><br/>'.$out2.'';
    //On envoie un bilan par email à l'admin
    $to = 'charlycop@free.fr';
    $subject = 'Bilan payout du '.$datetimepayout.'';
    $msg = $msgemail;
    $headers = 'From: BTC Doubler admin <1020916229@qq.com>'."\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
    $headers .= "\r\n";
    mail($to, $subject, $msg, $headers);
    }
?>