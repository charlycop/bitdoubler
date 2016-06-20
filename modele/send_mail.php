<?php
session_start(); // Pour commencer

// On contrôle le code avant tout

include_once '../securimage/securimage.php';
$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) 
	{
		// the code was incorrect
		// you should handle the error so that the form processor doesn't continue

		// or you can use the following code if there is no validation or you do not know how

		exit;
	}

// On sécurise les données
$useraddress = htmlspecialchars($_POST['useraddress']);
$email = htmlspecialchars($_POST['email']);
$name = htmlspecialchars($_POST['full_name']);
$message = htmlspecialchars($_POST['message']);


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
        //header('Location: ../index.php');
			echo "mail envoye";
        }

        else {
        // Si il y a erreur on renvoie sur le site
        echo 'Erreur pendant l\'envoi de l\'email';
        echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
        exit();
        }
	}
else
	{
		echo "The bitcoin address is invalid.<br /><br />";
		echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
	}


?>