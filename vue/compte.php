<?php
    require 'vendor/autoload.php';
    use Blocktrail\SDK\BlocktrailSDK;
    $client = new BlocktrailSDK("c614645a7f5d94b961ec3ed3dbd036c64ba42f34", "ef41c854d7fb246f5a4445d07cb9fe2a5b25a15f", "BTC", True /* testnet */);
    
    // On récupère la balance de l'adresse de l'utilisateur
    $userdetails=$client->address($_SESSION['useraddress']);
    $amount = BlocktrailSDK::toBTC($userdetails['balance']);
?>

<!-- TITLE -->
<div class="accounttitles">
    <img src="images/offer.png"/>
    <h1><?php echo strtoupper($myaccount); ?></h1>
</div>

<!-- DETAILS -->
<div class="col-md-13 col-sm-13">
    <div class="yourdetails-box">
        <div class="top-outer">
            <div class="top dark-blue">
                <h4><?php echo $mydetails; ?></h4>            
            </div>
        </div>
        <div class="bottom text-center blue-color">
            <br/><br/><h4><?php echo $yourwallettitle; ?></h4>
            <ul>
                <li><?php echo $yourwallet; ?><br/><?php echo $_SESSION['useraddress'];?></li>
                <li><?php echo $yourbalance; ?> : <?php echo $amount; ?> BTC</li>
            </ul>
            <div class="price-line"></div>
            <h4><br/><?php echo $depositaddresstitle; ?></h4>
            <ul>
                <li><?php echo $depositaddress1; ?><br/><?php echo $depositaddress2; ?></li>
                <li><!--img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=bitcoin:<?php echo $_SESSION['depositaddress']; ?>" /-->
                    
                    <?php
                        
                        $depositqrcode = 'images/depositqrcodes/'.$_SESSION['depositaddress'].'.png';
                        
                        // Si l'image n'existe pas, on la crée
                        if (!file_exists($depositqrcode))
                            {
                               include('phpqrcode/qrlib.php');
                            
                               // On créé l'image png et on la stocke
                               QRcode::png($_SESSION['depositaddress'], $depositqrcode, QR_ECLEVEL_H, 6, 3);
                            }                                                   
                    ?>  

                    <!-- On affiche le QRCODE PNG -->                
                    <img src="<?php echo $depositqrcode; ?>" alt="qrcode"/>

                </li>
                <li><?php echo $depositaddress3; ?><br/><strong><?php echo $_SESSION['depositaddress']; ?></strong></li>
            </ul>
            <div class="price-line"></div>
            <h4><br/><?php echo $referallinktitle; ?></h4>
            <ul>
                <li><?php echo $referal; ?></li>
                <li><strong>http://<?php echo ''.$_SERVER['HTTP_HOST'];?>/bitdoubler/index.php?aff=<?php echo ''.$_SESSION['affcode'].''; ?></strong></li>
            </ul>
            <div class="price-line"></div>
        </div>
    </div>
</div>
                 
<!-- DEPOSITS LIST -->
<?php
    include('modele/get_userdepotlist.php');
    $depotlist = userdepotlist($_SESSION['depositaddress']);

    // Si il y a des dépots
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
                            <h4><?php echo ''.$deposittitle.' #'.$depositnumber.'';?></h4>
                            <br/>
                            <?php
                            echo ''.$depositdate.' : '.$value['date_depot'].'<br />';
                            echo ''.$depositvalue.' : '.$btcamount.' BTC - '; ?>
                            <a href="https://www.blocktrail.com/tBTC/tx/<?php echo $value['hash']; ?>" target="_blank"><?php echo $see; ?></a><br />
                            <?php
                                if ($value['confirmations'] < 6)
                                    {
                                        $confirmed = $unconfirmed;
                                    }
                                echo ''.$confirmations.' : '.$value['confirmations'].'/6 ('.$confirmed.')<br />';
                                echo ''.$payouts.' : '.$value['nb_payouts'].'/10';
                            ?>
                        </div>      
                    </div>

                    <div class="payoutstitle">
                        <h4><?php echo $payoutslisttitle; ?></h4>
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
                                 <a href="https://www.blocktrail.com/tBTC/tx/<?php echo $valeur['hash_payout']; ?>" target="_blank"><?php echo $see; ?></a><br />
                                  <?php  $compteur = $compteur + 1;
                                }
                            }

                            else
                            {
                                echo $notyetpayout;
                            }
                        ?>
                    </div>
                </div>
            </div>     

                <?php
        }
    }

    // Si pas de dépôt, on affiche l'encart vide
    else
    { ?> 
        <div class="col-md-6 col-sm-6">
            <div class="depositlist-box">
                <div class="top-outer">
                    <div class="top red">
                        <h4><?php echo $deposittitle; ?> #1</h4>
                    </div>      
                </div>
                <div class="bottom text-center blue-color">
                    <ul>
                        <li><br/><?php echo $nodepositbaseline; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    <?php
    } 
?>

<!-- REFERAL GAINS -->
<div class="col-md-6 col-sm-6">
    <div class="depositlist-box">
        <div class="top-outer">
            <div class="top blue">
                <h4><?php echo $referalgainstitle; ?></h4>            
            </div>
        </div>
        <!--On affiche la liste des dépôts affiliés-->
        <div class="bottom text-center blue-color">

            <?php
              // On récupère la liste des plus gros deposits
                include('modele/get_useraffs.php');
                $listeaffs = get_useraffs($_SESSION['affcode']);

                if (isset($listeaffs[0]))
                {
                    foreach($listeaffs as $cle)
                    {   
                    $btcvalue = BlocktrailSDK::toBTC($cle['value']);
                    $gainvalue = $btcvalue/100*10 ;
                    ?>
                    <ul>
                    <li><?php echo ''.$cle['date_depot'].''; ?></li>
                    <li><?php echo ''.$userword.' : '.$cle['useradress'].''; ?></li>
                    <li><?php echo ''.$deposittitle.' : '.$btcvalue.' BTC'; ?></li>
                    <li><strong><?php echo ''.$yourprofit.' : '.$gainvalue.' BTC - ';?><a href="https://www.blocktrail.com/tBTC/tx/<?php echo $cle['parrainhash']; ?>" target="blank"><?php echo $see; ?></a></strong></li>
                    <li></strong></li>
                    </ul>
                    <div class="price-line"></div>
                    <?php    
                    } 
                }

                else
                { ?>
                    <div class="payoutslist">
                        <ul>
                            <li><br/><?php echo $norefferalbaseline; ?></li>
                        </ul>
                    </div>
                <?php
                } 
            ?>   
        </div>
    </div>
</div>