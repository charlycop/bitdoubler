<?php
    require 'vendor/autoload.php';
    use Blocktrail\SDK\BlocktrailSDK;
    $client = new BlocktrailSDK("c614645a7f5d94b961ec3ed3dbd036c64ba42f34", "ef41c854d7fb246f5a4445d07cb9fe2a5b25a15f", "BTC", true /* testnet */);
?>

<!DOCTYPE HTML>
<head>
    <title>Bitcoin Doubler</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style.css" />
    <!-- FAVICONS DEBUT -->
        <link rel="apple-touch-icon" sizes="57x57" href="css/favicons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="css/favicons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="css/favicons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="css/favicons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="css/favicons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="css/favicons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="css/favicons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="css/favicons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="css/favicons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="css/favicons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="css/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="css/favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="css/favicons/favicon-16x16.png">
        <link rel="manifest" href="css/favicons/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="css/favicons/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    <!-- FAVICONS FIN -->
</head>
    
<body>
    <h1>Doublez vos bitcoins</h1>


    <div id="compte">
       
        <?php 
            // On récupère la balance en satoshis
            $balance=$client->address($_SESSION['depositaddress']);

            // On converti la balance de satoshis en BTC
            $btcbalance=BlocktrailSDK::toBTC($balance['balance']);

            // On affiche les détails important du compte :
            echo 'User id = '.$_SESSION['user_id'].'';
            echo '<br>User Adress = '.$_SESSION['useraddress'].'';
            echo '<br>User deposit = '.$_SESSION['depositaddress'].''; 
            echo '<br>Total déposé : '.$btcbalance.' BTC';
        ?>

        <br>
        <!--ON AFFICHE LE QRCODE-->
        <img src="https://chart.googleapis.com/chart?chs=165x165&cht=qr&chl=bitcoin:<?php echo $_SESSION['depositaddress']; ?>" />
        
        <!--Lien d'affiliation-->
        <h2>Affiliate link = <a href="http://localhost/cours_php/api/index.php?aff=<?php echo ''.$_SESSION['affcode'].''; ?>">http://localhost/cours_php/api/index.php?aff=<?php echo ''.$_SESSION['affcode'].''; ?></a></h2>
       
        <br>
        <br>

        <?php
            // On récupère un array avec tous les transactions de la depositaddress
            //$transactions=$client->addressTransactions($_SESSION['depositaddress']);

            include('modele/get_userdepotlist.php');
            $depotlist = userdepotlist($_SESSION['depositaddress']);
            $total = 0;
            if (isset($depotlist['0']))
            {
                // On boucle sur le array pour afficher les détails des transactions
                foreach($depotlist as $cle => $value)
                {
                    //On converti le montant de la transactions de satoshis en BTC
                    $btcamount = BlocktrailSDK::toBTC($value['value']);

                    // On affiche les details :
                    echo 'Transaction : '.$value['hash'].'<br />';
                    echo 'Date : '.$value['date_depot'].'<br />';
                    echo 'Valeur : '.$btcamount.' BTC<br />';
                    echo 'Confirmations : '.$value['confirmations'].'/6<br /><br />';
                    $total = $total + $btcamount;
                }

                echo 'Montant total déposé : '.$total.' BTC';
            }

            else
            {
                echo 'Aucun dépôt pour le moment';
            }
        ?>
    </div>
</body>
</html>