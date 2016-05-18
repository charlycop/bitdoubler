 <?php
/*
	Author: Xenland
	Sponsored By: Cheaper In Bitcoins dot com ( http://cheaperinbitcoins.com )
	Info: Example on verifying a Bitcoin address
*/
	function appendHexZeros($inputAddress, $hexEncodedAddress){
	//Append Zeros where nessecary
	for ($i = 0; $i < strlen($inputAddress) && $inputAddress[$i] == "1"; $i++) {
		$hexEncodedAddress = "00" . $hexEncodedAddress;
	}
	if (strlen($hexEncodedAddress) % 2 != 0) {
		$hexEncodedAddress = "0" . $hexEncodedAddress;
	}
	
	return $hexEncodedAddress;
}
function encodeHex($dec){
        $chars="0123456789ABCDEF";
        $return="";
        while (bccomp($dec,0)==1){
                $dv=(string)bcdiv($dec,"16",0);
                $rem=(integer)bcmod($dec,"16");
                $dec=$dv;
                $return=$return.$chars[$rem];
        }
        return strrev($return);
}
function base58_decode($base58){
	$origbase58 = $base58;
	
	//Define vairables
	$base58chars = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";
	
	$return = "0";
	for ($i = 0; $i < strlen($base58); $i++) {
		$current = (string) strpos($base58chars, $base58[$i]);
		$return = (string) bcmul($return, "58", 0);
		$return = (string) bcadd($return, $current, 0);
	}
	return $return;
}

// Begin the real code
function adresschecker($address){

	$decodedAddress = base58_decode($address);

	$hexEncodedAddress = encodeHex($decodedAddress);
	$lastCharacter = substr($hexEncodedAddress, -8);

	//Append the 00 to the front of it
	$hexEncodedAddress = appendHexZeros($address, $hexEncodedAddress);

	//Remove last 8 characters from Hexencoded string
	$encodedAddress = substr($hexEncodedAddress, 0, strlen($hexEncodedAddress) - 8);

	//Convert to binary
	$binaryAddress = pack("H*" , $encodedAddress);

	//Hash(Hash(Value))
	$hashedAddress = strtoupper(hash("sha256", hash("sha256", $binaryAddress, true)));

	//Si l'adresse est vérifiée on cré le compte dans la BDD, sinon on revient en page d'accueil
	if ((substr($hashedAddress, 0 ,8)) == (substr($hexEncodedAddress, -8)))
		{
			$statut = true;
		}

	else
		{
			$statut = false;
		}

		return $statut;
}