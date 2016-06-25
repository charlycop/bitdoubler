<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" class="js">
<?php
    require 'vendor/autoload.php';
    use Blocktrail\SDK\BlocktrailSDK;
    $client = new BlocktrailSDK("c614645a7f5d94b961ec3ed3dbd036c64ba42f34", "ef41c854d7fb246f5a4445d07cb9fe2a5b25a15f", "BTC", true /* testnet */);
?>	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php echo $metadescription; ?>">
		
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
		
		<!-- Site Title  -->
		<title><?php echo $pagetitle; ?></title>

		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.css" >
		
		<!-- FontAwesome -->
		<link rel="stylesheet" href="lib/font-awesome-4.3.0/css/font-awesome.min.css" >
		
		<!-- OWL CSS -->
		<link rel="stylesheet" href="lib/owl.carousel/owl-carousel/owl.carousel.css"/>
		<link rel="stylesheet" href="lib/owl.carousel/owl-carousel/owl.theme.css"/>
		
		<!-- Custom styles for this template -->
		<link href="css/font.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/color.css" rel="stylesheet">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
		
	</head>
	
<!-- On affiche une popup en cas d'erreur dans la syntaxe de l'adresse btc pour créer le compte-->
<?php
	if (isset($_GET['create']) AND htmlspecialchars($_GET['create']) == 'btcnok')
		{?>
				<script>
					function myFunction() {
					    alert("<?php echo $btcnok; ?>");
					}
				</script>


			<body onload="myFunction()">
		<?php }

	else
		{?>
			<body>
		<?php }
?>
	
		
		<div class="home-area parallax">
			<div class="container">
			
				<div class="top-bar">
					<div class="row">
						<div class="col-md-6 col-sm-6 mobile-center">
							<div class="logo"><a href="#"><img src="images/bitcoincloner.png" alt="logo" /></a></div>
						</div>
						<div class="col-md-6 col-sm-6 text-right mobile-center">
							<a href="#form-area" class="button red go-form"><?php echo $support; ?><img src="images/support.png" alt="" /> </a>
							<a style="text-transform: uppercase;" href="index.php?lang=<?php echo $lang; ?>" id="lang" class="button blue">
								<img src="images/flags/<?php echo $lang; ?>.svg" alt="" style="height:26px;width:26px;border-radius:15px;" /> <?php echo $lang; ?> 
							</a>
									
							<ul id="langsel">
								<li><a style="text-transform: uppercase;" href="index.php?lang=<?php echo $langliste; ?>" id="lang">
									<img src="images/flags/<?php echo $langliste; ?>.svg" alt="" style=" height:26px;width:26px;border-radius:15px;" /> <?php echo $langliste; ?> </a></li> 
							</ul> 
						</div>
					</div>
				</div>
				<div class="home-more-area">
					<div class="row">
						<div class="col-md-6 tab-center">
							<img src="images/home2.png" alt="home" />
						</div>
						<div class="col-md-6 text-center">
							<div class="home-right">
								<div class="featured-offer">
									<div class="featured-offer-innr">
										<p><?php echo $minimal; ?></p>
										<h4>0.01 BTC</h4>
									</div>
								</div>
								<h6><?php echo $baseline1; ?></h6>
								<h2><?php echo $baseline2; ?></h2>
								<h5><?php echo $baseline3; ?></h5>
								<ul>
									<li><a href="#" class="button orange more-feature"><?php echo $morefeaturestitle; ?></a></li>
									<li>
										<a href="#" class="button blue scroll-account">
											<?php 
											if (isset($_SESSION['user_id']))
												{
													echo $myaccount;
												}

											else
												{
													echo $getstarted;
												}
											?>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		
		<div class="features-area">
			<div class="container">
				<div class="features-area-box-outer">
					<div class="features-area-box">
						<div class="row text-center">
							<div class="col-md-4 col-sm-6">
								<div class="single-feature">
									<img src="images/features-icon/large/1.png" alt="features" />
									<h6><?php echo $mainpoint1a; ?></h6>
									<div class="fetu-line"></div>
									<p><?php echo $mainpoint1b; ?></p>
								</div>
							</div>
							<div class="col-md-4 col-sm-6">
								<div class="single-feature">
									<img src="images/features-icon/large/2.png" alt="features" />
									<h6><?php echo $mainpoint2a; ?></h6>
									<div class="fetu-line"></div>
									<p><?php echo $mainpoint2b; ?></p>
								</div>
							</div>
							<div class="col-sm-3"></div>
							<div class="col-md-4 col-sm-6">
								<div class="single-feature">
									<img src="images/features-icon/large/3.png" alt="features" />
									<h6><?php echo $mainpoint3a; ?></h6>
									<div class="fetu-line"></div>
									<p><?php echo $mainpoint3b; ?></p>
								</div>
							</div>
							<div class="col-sm-3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="more-features-area" id="more-feature">
			<div class="container">
				<div class="section-head">
					<div class="row text-center">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<h3><?php echo $morefeaturestitle; ?></h3>
							<p><?php echo $morefeaturesbaseline; ?></p>
						</div>
						<div class="col-md-3"></div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-4 col-sm-6">
						<div class="single-more-features">
							<img src="images/features-icon/small/1.png" alt="features" />
							<h6><?php echo $feature1a; ?></h6>
							<p><?php echo $feature1b; ?></p>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="single-more-features">
							<img src="images/features-icon/small/2.png" alt="features" />
							<h6><?php echo $feature2a; ?></h6>
							<p><?php echo $feature2b; ?></p>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="single-more-features">
							<img src="images/features-icon/small/3.png" alt="features" />
							<h6><?php echo $feature3a; ?></h6>
							<p><?php echo $feature3b; ?></p>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="single-more-features">
							<img src="images/features-icon/small/4.png" alt="features" />
							<h6><?php echo $feature4a; ?></h6>
							<p><?php echo $feature4b; ?></p>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="single-more-features">
							<img src="images/features-icon/small/5.png" alt="features" />
							<h6><?php echo $feature5a; ?></h6>
							<p><?php echo $feature5b; ?></p>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="single-more-features">
							<img src="images/features-icon/small/6.png" alt="features" />
							<h6><?php echo $feature6a; ?></h6>
							<p><?php echo $feature6b; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		

		
		<div id="account" class="cta-area parallax">
			<div class="container">
				<div class="row">
					<?php
						if (isset($_GET['account'])) 
						{
						    include_once('modele/get_user.php');
						    $user = get_user(htmlspecialchars($_GET['account']));

						    //On ferme la session vide
						    session_destroy();

						    // On démarre la réelle session
						    session_start();
						    $_SESSION['user_id'] = $user['id_user'];
						    $_SESSION['useraddress'] = htmlspecialchars($_GET['account']);
						    $_SESSION['depositaddress'] = $user['depositaddress'];
						    $_SESSION['affcode'] = $user['affcode'];
						    $_SESSION['lang'] = htmlspecialchars($lang);

						    include('vue/compte.php');
						}

						else
						{   
						    if (isset($_GET['aff']))
						    {
						        $parraincode = htmlspecialchars($_GET['aff']);
						    }

						    else
						    {
						        $parraincode = 'parrainunknow';
						    }
						    ?>
							<form enctype="multipart/form-data" action="modele/creation_compte.php" method="post">
														<div class="col-md-2 col-sm-5">
															<div class="cta-offer hidden-xs">
																<img src="images/offer.png" alt="offer" />
															</div>
														</div>
														<div class="col-md-7 col-sm-7">
															<h5><?php echo $subscriptionformtitle; ?></h5>
															<div class="form">
															<input type="text" name="useraddress" placeholder="<?php echo $subscriptionformplaceholder; ?>" value="" required>
															</div>
														
														</div>
														<div class="col-md-3 mobile-center">
															<input type="hidden" id="parraincode" name="parraincode" value="<?php echo ''.$parraincode.'';?>" />
															<input type="submit" class="button orange" value="<?php echo $subscriptionformbutton; ?>">
														</div>
													</form>
						<?php 
						} 						
					?>

				</div>
			</div>
		</div>

				<div class="pricing-area">
			<div class="container">
				<div class="section-head">
					<div class="row text-center">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<h3><?php echo $statisticstitle; ?></h3>
						</div>
						<div class="col-md-3"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-6">
						<div class="single-pricing">
							<div class="top-outer">
								<div class="top red">
									<h4><?php echo $lastdeposits; ?></h4>
								</div>
							</div>
							<div class="bottom text-center red-color">

								<?php
									// On récupère la liste des derniers deposits
									include('modele/get_lastdeposits.php');
									$lastdeposits = get_lastdeposits('15');

									foreach ($lastdeposits as $key => $value) 
									{
										$btcdepositamount = BlocktrailSDK::toBTC($value['value']);
										?>
										<ul>
											<li><strong><?php echo ''.$btcdepositamount.''; ?> BTC</strong></li>
											<li><a target="_blank" href="https://www.blocktrail.com/tBTC/tx/<?php echo ''.$value['hash'].''; ?>"><?php echo $seetransaction; ?></a></li>
											<li><?php echo ''.$value['date_depot'].''; ?></li>
										</ul>
										<div class="price-line"></div>
										<?php
									} 	?>
								
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="single-pricing">
							<div class="top-outer">
								<div class="top dark-blue">
									<h4><?php echo $lastpayouts; ?></h4>
								</div>
							</div>
							<div class="bottom text-center dark-blue-color">
								
								<?php
									// On récupère la liste des derniers payouts
									include('modele/get_lastpayouts.php');
									$lastpayouts = get_lastpayouts('15');

									foreach ($lastpayouts as $key => $value) 
									{
										$btcpayoutamount = BlocktrailSDK::toBTC($value['value']);
										$btcpayoutamount = $btcpayoutamount / 100 * 2;
										?>
										<ul>
											<li><strong><?php echo ''.$btcpayoutamount.''; ?> BTC</strong></li>
											<li><a target="_blank" href="https://www.blocktrail.com/tBTC/address/<?php echo ''.$value['useradress'].''; ?>"><?php echo $seetransaction; ?></a></li>
											<li><?php echo ''.$value['date_payout'].''; ?> (<?php echo ''.$value['nb_payouts'].''; ?>/10)</li>
										</ul>
										<div class="price-line"></div>
										<?php
									} 	?>
							</div>
						</div>
					</div>
					<div class="col-sm-3"></div>
					<div class="col-md-4 col-sm-6">
						<div class="single-pricing">
							<div class="top-outer">
								<div class="top blue">
									<h4><?php echo $topdeposits; ?></h4>
								</div>
							</div>
							<div class="bottom text-center blue-color">
								<?php
									// On récupère la liste des plus gros deposits
									include('modele/get_topdeposits.php');
									$topdeposits = get_topdeposits('15');

									foreach ($topdeposits as $key => $value) 
									{
										$btctopamount = BlocktrailSDK::toBTC($value['value']);
										?>
										<ul>
											<li><strong><?php echo ''.$btctopamount.''; ?> BTC</strong></li>
											<li><a target="_blank" href="https://www.blocktrail.com/tBTC/tx/<?php echo ''.$value['hash'].''; ?>"><?php echo $seetransaction; ?></a></li>
											<li><?php echo ''.$value['date_depot'].''; ?></li>
										</ul>
										<div class="price-line"></div>
										<?php
									} 	?>
							</div>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</div>
		</div>

		<div class="pricing-area">
			<div class="container">
				<div class="section-head">
					<div class="row text-center">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<h3><?php echo $faqtitle; ?></h3>
						</div>
					</div>
					<div>
						<h5><?php echo $question1; ?></h5>
						<h6><?php echo $answer1; ?></h6>
						<hr>
					</div>
					<div>
						<h5><?php echo $question2; ?></h5>
						<h6><?php echo $answer2; ?></h6>
						<hr>
					</div>
					<div>
						<h5><?php echo $question3; ?></h5>
						<h6><?php echo $answer3; ?></h6>
						<hr>
					</div>
					<div>
						<h5><?php echo $question4; ?></h5>
						<h6><?php echo $answer4; ?></h6>
						<hr>
					</div>
					<div>
						<h5><?php echo $question5; ?></h5>
						<h6><?php echo $answer5; ?></h6>
						<hr>
					</div>
					<div>
						<h5><?php echo $question6; ?></h5>
						<h6><?php echo $answer6; ?></h6>
						<hr>
					</div>
					<div>
						<h5><?php echo $question7; ?></h5>
						<h6><?php echo $answer7; ?></h6>
						<hr>
					</div>
					<div>
						<h5><?php echo $question8; ?></h5>
						<h6><?php echo $answer8; ?></h6>
						<hr>
					</div>
					<div>
						<h5><?php echo $question10; ?></h5>
						<h6><?php echo $answer10; ?></h6>
						<hr>
					</div>
					<div>
						<h5><?php echo $question11; ?></h5>
						<h6><?php echo $answer11; ?></h6>
						<hr>
					</div>
				</div>
			</div>
		</div>




		<div style="height:40px;"></div>




		<div class="form-area" id="form-area">
			<div class="container">
				<div class="form-area-box-outer">
					<div class="form-area-box">
						<div class="section-head">
							<div class="row text-center">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<h3><?php echo $contactformtitle; ?></h3>
									<p><?php echo $contactformbaseline; ?></p>
								</div>
								<div class="col-md-2"></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 col-sm-2"></div>
							<div class="col-md-6 col-sm-8">
								<div class="form">
									<form  action="modele/send_mail.php" method="post" class="contact-form text-center">
										<!-- Message d'erreur si nécessaire -->
										<?php
											if (isset($error)) 
												{?>
													<p id="error"><?php echo $error; ?></p>
												<?php } ?>
										
										<input id="cf-name" type="text" name="full_name" placeholder="<?php echo $formnameplaceholder; ?>" value="">
										<input id="cf-email" type="email" name="email" placeholder="<?php echo $formemailplaceholder; ?>" value="" required>
										<input id="cf-address" type="text" name="useraddress" placeholder="<?php echo $formaddressplaceholder; ?>" value="" required>
										<textarea name="message" placeholder="<?php echo $formmessageplaceholder; ?>" required></textarea> 
										<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" /><a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false"> <img src="securimage/images/refresh.png"></a>
										<input type="text" name="captcha_code" size="10" maxlength="6" placeholder="<?php echo $formcaptchaplaceholder; ?>"/>
										<input type="submit" class="button red" value="<?php echo $formsendbutton; ?>" />
									</form>
								</div>
							</div>
							<div class="col-md-3 col-sm-2"></div>
						</div>
						<div class="row text-center">
							<div class="col-md-12">
								<p><?php echo $footerweaccept; ?></p>
								<ul class="payment-methods">
									<li><img src="images/payment/2.png" alt="Bitcoin" /></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-bar">
			<div class="container">
				<div class="row text-center">
					<div class="col-md-12">
						<p><?php echo $footercopyrights; ?></a></p>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		
		<script src="js/jquery.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- jQuery Parallax
		================================================== -->
		<script src="lib/jquery-parallax/scripts/jquery.parallax-1.1.3.js"></script>
		
		<!-- jQuery OWL
		================================================== -->
		<script src="lib/owl.carousel/owl-carousel/owl.carousel.min.js"></script>
		
		<!-- jQuery ajaxchimp
		================================================== -->
		<script src="js/jquery.ajaxchimp.min.js"></script>	
	
		<!-- jQuery Custom
		================================================== -->
		<script src="js/custom.js" type="text/javascript"></script>
		
		<!-- Tweet Script
		================================================== -->
	</body>

</html>