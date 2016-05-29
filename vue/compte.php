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
        <table>
             
                <?php
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
                            ?>
                            <tr>
                                <td>
                                    <?php
                                        // On affiche les details :
                                        echo 'Transaction : '.$value['hash'].'<br />';
                                        echo 'Date : '.$value['date_depot'].'<br />';
                                        echo 'Valeur : '.$btcamount.' BTC<br />';
                                        echo 'Confirmations : '.$value['confirmations'].'/6 - ';
                                        echo 'Nombre de paiements : '.$value['nb_payouts'].'/10';
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        include_once('modele/get_payoutstx.php');
                                        $tx_liste = get_payoutstx($value['id_deposit']);
                                        $btcpayout = ($btcamount/100*2);
                                        $compteur = 1;

                                        // On boucle sur la liste des payouts de ce dépôt
                                        foreach($tx_liste as $key => $valeur)
                                        {   
                                            echo ''.$valeur['date_payout'].' - ';
                                            echo ''.$btcpayout.' BTC - ';
                                            echo ''.$compteur.'/10<br />';
                                            $compteur = $compteur + 1;
                                        }
                                    ?>
                                </td>

                            </tr>
                                <?php
                                    $total = $total + $btcamount;

                        }

                        echo 'Montant total déposé : '.$total.' BTC';
                    }

                    else
                    {
                        echo 'Aucun dépôt pour le moment';
                    }
                ?>

        </table>

        <br><br>
       
        <!--On affiche la liste des dépôts affiliés-->
        <?php
            include('modele/get_useraffs.php');
            $listeaffs = get_useraffs($_SESSION['affcode']);
        ?>
        <table>
            <tr>
            <th>Deposit date</th>
            <th>User</th>
            <th>Deposit Value</th>
            <th>Your gain</th>
            <th>Payment</th>
            </tr>
            <!--On boucle sur le array pour afficher les détails des transactions-->
            <?php 
            foreach($listeaffs as $cle)
            {   ?>

            <tr>
                <td>
                    <?php echo ''.$cle['date_depot'].''; ?>
                </td>
                <td>
                    <?php echo ''.$cle['useradress'].''; ?>
                </td>
                <td>
                    <?php
                        $btcvalue = BlocktrailSDK::toBTC($cle['value']);
                        echo ''.$btcvalue.' BTC'; ?>
                </td>
                <td>
                    <?php 
                        $gainvalue = $btcvalue/100*10 ;
                        echo ''.$gainvalue.' BTC'; ?>
                </td>
                <td>
                    <a href="https://www.blocktrail.com/tBTC/tx/<?php echo ''.$cle['parrainhash'].''; ?>" target="blank">See</a>
                </td>
            </tr>
            <?php 
            }
            ?>

        </table>

    </div>
</body>
</html>