<?php
    require '../vendor/autoload.php';
    use Blocktrail\SDK\BlocktrailSDK;
    include_once('../modele/connexion_sql.php');
    $client = new BlocktrailSDK("c614645a7f5d94b961ec3ed3dbd036c64ba42f34", "ef41c854d7fb246f5a4445d07cb9fe2a5b25a15f", "BTC", true /* testnet */);
    $wallet = $client->initWallet("wallet2", "254777");

    // On récupère la liste des paiements à faire depuis la BDD
    include('../modele/get_topayout.php');
    $payoutList = topayout();

    // On initialise la liste (adresse,montant) pour l'API
    $payoutArray=Array();

    // On rempli un array au format demandé par l'API partir des données brut de la BDD récupérées dans $payoutList 
    foreach($payoutList as $cle)
    {
        $payoutArray[$cle['useradress']] = (int) $cle['value'];
    }

    // On lance effectivement les paiements via l'API et on récupère le numero de transaction dans $hash_payments
    $hash_payments=$wallet->pay($payoutArray, null, false, true);
    ?>

    <!-- On affiche le numéro de transaction avec un lien direct -->
    <html>
        <body>
            Transaction OK : 
            <a href="https://www.blocktrail.com/tBTC/tx/<?php echo $hash_payments; ?>">
                <?php echo $hash_payments; ?>
            </a>
        </body>
    </html>