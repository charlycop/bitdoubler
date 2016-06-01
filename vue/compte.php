<?php
    require 'vendor/autoload.php';
    use Blocktrail\SDK\BlocktrailSDK;
    $client = new BlocktrailSDK("c614645a7f5d94b961ec3ed3dbd036c64ba42f34", "ef41c854d7fb246f5a4445d07cb9fe2a5b25a15f", "BTC", true /* testnet */);
?>

  <h1>Doublez vos bitcoins</h1>


    
       
        <?php 
           
            // On affiche les détails important du compte :
            echo 'User id = '.$_SESSION['user_id'].'';
            echo '<br>User Adress = '.$_SESSION['useraddress'].'';
            echo '<br>User deposit = '.$_SESSION['depositaddress'].''; 

        ?>

        <br>
        <!--ON AFFICHE LE QRCODE-->
        <img src="https://chart.googleapis.com/chart?chs=165x165&cht=qr&chl=bitcoin:<?php echo $_SESSION['depositaddress']; ?>" />
        
        <!--Lien d'affiliation-->
        <h2>Affiliate link = <a href="http://<?php echo ''.$_SERVER['HTTP_HOST'];?>/bitdoubler/index.php?aff=<?php echo ''.$_SESSION['affcode'].''; ?>">http://<?php echo ''.$_SERVER['HTTP_HOST'];?>/bitdoubler/index.php?aff=<?php echo ''.$_SESSION['affcode'].''; ?></a></h2>
       
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

    
