<?php
session_start(); // Pour commencer

// On contrôle le code avant tout

include_once '../securimage/securimage.php';
$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) 
	{
		// Si il y a erreur sur le code captcha
        header('Location: ../index.php?mail=captchanok#form-area');
        exit();
	}

// On sécurise les données
$useraddress = htmlspecialchars($_POST['useraddress']);
$email = htmlspecialchars($_POST['email']);
$name = htmlspecialchars($_POST['full_name']);
$message = htmlspecialchars($_POST['message']);
$message .= '**User Adress Session : '.$_POST['sessionuseraddress'].'';


// On vérifie l'adresse bitcoin et si ok, on prépare et envoi le mail.

include('addresschecker.php');
if (adresschecker($useraddress))
	{
		$subject = "[".$name."] - ".$useraddress."";
		$to = "charlycop@free.fr";
		$headers   = array();
			$headers[] = "MIME-Version: 1.0";
			$headers[] = "Content-type: text/plain; charset=utf-8";
			$headers[] = "From: ".$email."";
			//$headers[] = "Bcc:";
			$headers[] = "Reply-To: ".$email."";
			//$headers[] = "Subject: {$subject}";
			$headers[] = "X-Mailer: PHP/".phpversion();

		/*$headers = 	'From: '.$email.'' . "\r\n" .
   					'Reply-To: '.$email.'' . "\r\n" .
  					'X-Mailer: PHP/' . phpversion();*/
		
		if (mail($to, $subject, $message, implode("\r\n", $headers))) 
		{
        //Puis on renvoie sur monsiteweb.org, if permet de tester si mail() à bien fonctioné (ceci ne garanti pas que le mail sera recu, mais c'est un début)
        header('Location: ../index.php?mail=ok#form-area');
        }

        else {
        // Si il y a erreur on renvoie sur le site
        header('Location: ../index.php?mail=unknownok#form-area');
        }
	}
else
	{
		//renvoi sur le site car l'adresse btc n'est pas valide
		header('Location: ../index.php?mail=btcaddressnok#form-area');
	}


?>