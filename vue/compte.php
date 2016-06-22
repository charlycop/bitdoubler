<?php
    require 'vendor/autoload.php';
    use Blocktrail\SDK\BlocktrailSDK;
    $client = new BlocktrailSDK("c614645a7f5d94b961ec3ed3dbd036c64ba42f34", "ef41c854d7fb246f5a4445d07cb9fe2a5b25a15f", "BTC", true /* testnet */);
?>
<div class="accounttitles">
<h1>YOUR ACCOUNT</h1>
<h5><?php echo '<br>Your Bitcoin Address : '.$_SESSION['useraddress'].'';
            

        ?></h5>
</div>
 

                    <div class="col-md-13 col-sm-13">
                       <div class="yourdetails-box">
                           <div class="top-outer">
                                <div class="top dark-blue">
                                    <h4>Your Details</h4>            
                                </div>
                            </div>
                    <!--On affiche la liste des dépôts affiliés-->
                            <div class="bottom text-center blue-color">
                                <ul>
                                    <li>Send any amount from 0.01BTC to your personnal deposit bitcoin address below, and start a doubling campaign immediately</li>
                                    <li><img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=bitcoin:<?php echo $_SESSION['depositaddress']; ?>" /></li>
                                    <li><?php echo 'Use the QrCode above or the text address below <br/><strong>'.$_SESSION['depositaddress'].'</strong>'; ?></li>
                                </ul>
                                <div class="price-line"></div>
                                <ul>
                                    <li>Share your referal link below, and get an instant and automated payment from all the deposits of the users using your link</li>
                                    <li><strong>http://<?php echo ''.$_SERVER['HTTP_HOST'];?>/bitdoubler/index.php?aff=<?php echo ''.$_SESSION['affcode'].''; ?></strong></li>
                                </ul>
                                <div class="price-line"></div>

    
                            </div>
                        </div>
                    </div>
    
       
       

        <br/>
                            

        <?php
            include('modele/get_userdepotlist.php');
            $depotlist = userdepotlist($_SESSION['depositaddress']);

            if (isset($depotlist['0']))
            {
                // On boucle sur le array pour afficher les détails des transactions
                $depositnumber = 0;
                foreach($depotlist as $cle => $value)
                {   
                    //On converti le montant de la transactions de satoshis en BTC
                    $btcamount = BlocktrailSDK::toBTC($value['value']);
                    $depositnumber = $depositnumber + 1;
                    ?>
                    <div class="col-md-6 col-sm-6">
                        <div class="depositlist-box">
                            <div class="top-outer">
                                <div class="top red">
                                    <h4>Deposit #<?php echo $depositnumber;?></h4>
                                    <?php
                                    echo '<br/>Date : '.$value['date_depot'].'<br />';
                                    echo 'Value : '.$btcamount.' BTC - '; ?>
                                    <a href="https://www.blocktrail.com/tBTC/tx/<?php echo $value['hash']; ?>" target="_blank">See Tx</a><br />
                                    <?php
                                        if ($value['confirmations'] < 6)
                                            {
                                                $confirmed = '(unconfirmed yet)';
                                                $payouts = 'Once we receive 6 confirmations from the bitcoin network, the automated hourly instant payouts will begin.';
                                            }
                                        else
                                            {
                                                $confirmed = '(confirmed)';
                                            }
                                        echo 'Confirmations : '.$value['confirmations'].'/6 '.$confirmed.'<br />';
                                        echo 'Payouts : '.$value['nb_payouts'].'/10';
                                    ?>
                                </div>      
                            </div>

                            <div class="payoutstitle">
                                <h4>Payouts list</h4>
                            </div>
                            
                            <div class="price-line">
                            </div>
                            
                            <div class="payoutslist">
                                <?php
                                    if ($value['confirmations'] == 6)
                                    {
                                        include_once('modele/get_payoutstx.php');
                                        $tx_liste = get_payoutstx($value['id_deposit']);
                                        $btcpayout = ($btcamount/100*2);
                                        $compteur = 1;

                                        // On boucle sur la liste des payouts de ce dépôt
                                        foreach($tx_liste as $key => $valeur)
                                        {   
                                            echo ''.$valeur['date_payout'].' - ';
                                            echo ''.$btcpayout.' BTC - ';
                                            $nb_payout = sprintf("%03d", $compteur);
                                            echo ''.$nb_payout.'/100 - ';
                                            ?>
                                         <a href="https://www.blocktrail.com/tBTC/tx/<?php echo $valeur['hash_payout']; ?>" target="_blank">See</a><br />
                                          <?php  $compteur = $compteur + 1;
                                        }
                                    }

                                    else
                                    {
                                        echo $payouts;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>     

                        <?php
                    }

            }
                        ?>


                    <div class="col-md-6 col-sm-6">
                        <div class="depositlist-box">
                            <div class="top-outer">
                                <div class="top blue">
                                    <h4>Your Referrals Gains</h4>            
                                </div>
                            </div>
                            <!--On affiche la liste des dépôts affiliés-->
                            <div class="bottom text-center blue-color">

                                <?php
                                  // On récupère la liste des plus gros deposits
                                    include('modele/get_useraffs.php');
                                    $listeaffs = get_useraffs($_SESSION['affcode']);

                                    foreach($listeaffs as $cle)
                                    {   
                                        $btcvalue = BlocktrailSDK::toBTC($cle['value']);
                                        $gainvalue = $btcvalue/100*10 ;
                                ?>
                                        <ul>
                                        <li><?php echo ''.$cle['date_depot'].''; ?></li>
                                        <li><?php echo 'User : '.$cle['useradress'].''; ?></li>
                                        <li><?php echo 'Deposit : '.$btcvalue.' BTC'; ?></li>
                                        <li><strong><?php echo 'Your profit : '.$gainvalue.' BTC - ';?><a href="https://www.blocktrail.com/tBTC/tx/<?php echo $cle['parrainhash']; ?>" target="blank">See</a></strong></li>
                                        <li></strong></li>
                                        </ul>
                                        <div class="price-line"></div>
                                        <?php    
                                    }   ?>
                            </div></div>
                        </div>
                    </div>

